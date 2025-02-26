<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sports;
class SportsController extends Controller
{
    public function index(Request $request)
    {
        $getsportslist = Sports::get();
        return view('admin.sports.index', compact('getsportslist'));
    }
    public function add(Request $request)
    {
        return view('admin.sports.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sports,name',
            'image' => 'mimes:png,jpg,jpeg,svg|max:7168'
        ], [
            'name.required' => trans('messages.name_required'),
            'name.unique' => trans('messages.sport_exist'),
            'image.mimes' => trans('messages.valid_image_type'),
            'image.max' => trans('messages.valid_image_size'),
        ]);
        if ($request->hasFile('image')) {
            $image = 'sport-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $path = storage_path('app\public\admin\images\sports');
            $request->image->move($path, $image);
        } else {
            $image = 'default-sport.png';
        }
        $sports = new Sports();
        $sports->name = $request->name;
        $sports->image = $image;
        $sports->save();
        return redirect('admin/sports')->with('success', 'Added Successfully');
    }
    public function change_status(Request $request)
    {
        $user = Sports::find($request->id);
        $user->is_available = $request->status;
        $user->save();
        return 1;
    }
    public function delete(Request $request)
    {
        $user = Sports::find($request->id);
        $user->is_deleted = $request->status;
        $user->save();
        return 1;
    }
    public function edit(Request $request)
    {
        $sportsdata = Sports::find($request->id);
        return view('admin.sports.edit', compact('sportsdata'));
    }
    public function update(Request $request)
    {
        $checksport = Sports::find($request->id);
        $request->validate([
            'name' => 'required|unique:sports,name,' . $request->id,
        ], [
            'name.required' => trans('messages.name_required'),
            'name.unique' => trans('messages.sport_exist')
        ]);
        if ($request->has('image')) {
            $request->validate([
                'image' => 'mimes:png,jpg,jpeg,svg|max:7168'
            ], [
                'image.mimes' => trans('messages.valid_image_type'),
                'image.max' => trans('messages.valid_image_size'),
            ]);
            if ($checksport->image != 'default-sport.png' && file_exists('storage/app/public/admin/images/sports/' . $checksport->image)) {
                unlink('storage/app/public/admin/images/sports/' . $checksport->image);
            }
            $new_name = 'sport-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $path = storage_path('app\public\admin\images\sports');
            $request->image->move($path, $new_name);
            $checksport->image = $new_name;
        }
        $checksport->name = $request->name;
        $checksport->save();
        return redirect('admin/sports')->with('success', 'Updated Successfully');
    }
}
