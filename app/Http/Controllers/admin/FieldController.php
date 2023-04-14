<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Sports;
use App\Models\Domes;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->id == 1) {
            $fields = Field::where('is_available', 1)->where('is_deleted', 2)->get();
        } else {
            $fields = Field::where('vendor_id', auth()->user()->id)->where('is_available', 1)->where('is_deleted', 2)->get();
        }
        return view('admin.field.index', compact('fields'));
    }
    public function add(Request $request)
    {
        $dome = Domes::where('vendor_id', auth()->user()->id)->where('is_deleted', 2)->get();
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.field.add', compact('dome', 'getsportslist'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'dome' => 'required',
            'sport_id' => 'required',
            'field_name' => 'required|numeric',
            'min_person' => 'required',
            'max_person' => 'required',
            'field_image' => 'required|image|mimes:png,jpg,jpeg,svg|max:500',
        ], [
            'dome.required' => trans('messages.select_dome'),
            'sport_id.required' => trans('messages.select_sport'),
            'field_name.required' => trans('messages.field_name_required'),
            'field_name.numeric' => trans('messages.numbers_only'),
            'min_person.required' => trans('messages.select_minimum_person'),
            'max_person.required' => trans('messages.select_maximum_person'),
            'field_image.required' => trans('messages.image_required'),
            'field_image.image' => trans('messages.valid_image'),
            'field_image.mimes' => trans('messages.valid_image_type'),
            'field_image.max' => trans('messages.valid_image_size'),
        ]);
        $new_name = 'field-' . uniqid() . '.' . $request->field_image->getClientOriginalExtension();
        $path = storage_path('app\public\admin\images\fields');
        $request->field_image->move($path, $new_name);
        $field = new Field();
        $field->vendor_id = auth()->user()->id;
        $field->dome_id = $request->dome;
        $field->sport_id = $request->sport_id;
        $field->name = $request->field_name;
        $field->min_person = $request->min_person;
        $field->max_person = $request->max_person;
        $field->image = $new_name;
        $field->save();
        return redirect('admin/fields')->with('success', trans('messages.success'));
    }
    public function edit(Request $request)
    {
        $field = Field::find($request->id);
        $dome = Domes::where('vendor_id', auth()->user()->id)->where('is_deleted', 2)->get();
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->select('id', 'name')->get();
        return view('admin.field.edit', compact('dome', 'getsportslist', 'field'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'dome' => 'required',
            'sport_id' => 'required',
            'field_name' => 'required|numeric',
            'min_person' => 'required',
            'max_person' => 'required',
            'field_image' => 'image|mimes:png,jpg,jpeg,svg|max:500',
        ], [
            'dome.required' => trans('messages.select_dome'),
            'sport_id.required' => trans('messages.select_sport'),
            'field_name.required' => trans('messages.field_name_required'),
            'field_name.numeric' => trans('messages.numbers_only'),
            'min_person.required' => trans('messages.select_minimum_person'),
            'max_person.required' => trans('messages.select_maximum_person'),
            'field_image.image' => trans('messages.valid_image'),
            'field_image.mimes' => trans('messages.valid_image_type'),
            'field_image.max' => trans('messages.valid_image_size'),
        ]);
        $field = Field::find($request->id);
        $field->vendor_id = auth()->user()->id;
        $field->dome_id = $request->dome;
        $field->sport_id = $request->sport_id;
        $field->name = $request->field_name;
        $field->min_person = $request->min_person;
        $field->max_person = $request->max_person;
        if ($request->has('field_image')) {
            // if (file_exists('storage/app/public/admin/images/fields/' . $field->image)) {
            //     unlink('storage/app/public/admin/images/fields/' . $field->image);
            // }
            $new_name = 'field-' . uniqid() . '.' . $request->field_image->getClientOriginalExtension();
            $path = storage_path('app\public\admin\images\fields');
            $request->field_image->move($path, $new_name);
            $field->image = $new_name;
        }
        $field->save();
        return redirect('admin/fields')->with('success', trans('messages.success'));
    }
    public function delete(Request $request)
    {
        try {
            $field = Field::find($request->id);
            $field->is_deleted = 1;
            $field->save();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
    public function maintenance(Request $request)
    {
        try {
            $field = Field::find($request->id);
            if ($field->in_maintenance == 1) {
                $field->in_maintenance = 2;
                $field->maintenance_date = null;
                $field->save();
            } else {
                $checkd = Booking::whereRaw("find_in_set('" . $field->id . "',field_id)")->where('type', 1)->whereIn('booking_status', [1, 2])->whereDate('start_date', date('Y-m-d', strtotime($request->date)))->first();
                $checkl = Booking::whereRaw("find_in_set('" . $field->id . "',field_id)")->where('type', 2)->whereIn('booking_status', [1, 2])->whereDate('start_date', '<=', $request->date)->whereDate('end_date', '>=', $request->date)->first();
                if (!empty($checkd) || !empty($checkl)) {
                    return response()->json(['status' => 2, 'message' => trans('messages.unable_set_maintenance')], 200);
                }
                $field->in_maintenance = 1;
                $field->maintenance_date = $request->date;
                $field->save();
            }
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
