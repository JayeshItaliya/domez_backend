<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sports;
use App\Models\Domes;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->id == 1) {
            $fields = Field::where('is_available',1)->where('is_deleted',2)->get();
        } else {
            $fields = Field::where('vendor_id', Auth::user()->id)->where('is_available',1)->where('is_deleted',2)->get();
        }
        return view('admin.field.index',compact('fields'));
    }

    public function add(Request $request)
    {
        $dome = Domes::where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->get();
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->get();

        return view('admin.field.add', compact('dome', 'getsportslist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dome' => 'required',
            'sport_id' => 'required',
            'field_name' => 'required|unique:fields,name',
            'min_person' => 'required',
            'max_person' => 'required',
            'field_image' => 'required|mimes:png,jpg,jpeg,svg|max:500',
        ], [
            'dome.required' => 'Please Select Dome',
            'sport_id.required' => 'Please Select Sport',
            'field_name.required' => 'Please Enter Field Name',
            'field_name.unique' => 'This Field Already Added',
            'min_person.required' => 'Set Minimum Person',
            'max_person.required' => 'Set Maximum Person',
            'max_person.required' => 'Set Maximum Person',
            'field_image.required' => 'Select Field Image',
            'field_image.mimes' => 'The Profile Image must be a file of type: PNG, JPG, JPEG, SVG',
            'field_image.max' => 'The image must not be greater than 500KB.',
        ]);

        $new_name = 'field-' . rand(0000, 9999) . '.' . $request->field_image->getClientOriginalExtension();
        $path = storage_path('app\public\admin\images\fields');
        $request->field_image->move($path, $new_name);

        $field = new Field;
        $field->vendor_id = Auth::user()->id;
        $field->dome_id = $request->dome;
        $field->sport_id = $request->sport_id;
        $field->name = $request->field_name;
        $field->min_person = $request->min_person;
        $field->max_person = $request->max_person;
        $field->image = $new_name;
        $field->save();

        return redirect('admin/field')->with('success', 'Added Successfully');
    }

    public function edit(Request $request)
    {
        $field = Field::find($request->id);
        $dome = Domes::where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->get();
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->select('id','name')->get();
        return view('admin.field.edit', compact('dome', 'getsportslist','field'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'dome' => 'required',
            'sport_id' => 'required',
            'field_name' => 'required|unique:fields,name,'.$request->id,
            'min_person' => 'required',
            'max_person' => 'required',
            'field_image' => 'mimes:png,jpg,jpeg,svg|max:500',
        ], [
            'dome.required' => 'Please Select Dome',
            'sport_id.required' => 'Please Select Sport',
            'field_name.required' => 'Please Enter Field Name',
            'field_name.unique' => 'This Field Already Added',
            'min_person.required' => 'Set Minimum Person',
            'max_person.required' => 'Set Maximum Person',
            'max_person.required' => 'Set Maximum Person',
            'field_image.mimes' => 'The Profile Image must be a file of type: PNG, JPG, JPEG, SVG',
            'field_image.max' => 'The image must not be greater than 500KB.',
        ]);


        $field = Field::find($request->id);
        $field->dome_id = Auth::user()->id;
        $field->dome_id = $request->dome;
        $field->sport_id = $request->sport_id;
        $field->name = $request->field_name;
        $field->min_person = $request->min_person;
        $field->max_person = $request->max_person;
        if ($request->has('field_image')) {
            if (file_exists('storage/app/public/admin/images/fields/' . $field->image)) {
                unlink('storage/app/public/admin/images/fields/' . $field->image);
            }
            $new_name = 'field-' . rand(0000, 9999) . '.' . $request->field_image->getClientOriginalExtension();
            $path = storage_path('app\public\admin\images\fields');
            $request->field_image->move($path, $new_name);
            $field->image = $new_name;
        }
        $field->save();

        return redirect('admin/field')->with('success', 'Updated Successfully');
    }

    public function delete(Request $request)
    {
        $field = Field::find($request->id);
        $field->is_deleted = $request->status;
        $field->save();

        return 1;
    }
}
