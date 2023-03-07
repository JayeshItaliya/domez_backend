<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sports;
use Illuminate\Http\Request;
use App\Models\Domes;
use App\Models\DomeImages;
use Illuminate\Support\Facades\Auth;

class DomesController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->id == 1) {
            $domes = Domes::with('dome_image','dome_owner')->where('is_deleted', 2)->get();
        } else {
            $domes = Domes::with('dome_image')->where('vendor_id', Auth::user()->id)->where('is_deleted', 2)->get();
        }
        $sports = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.domes.index', compact('domes','sports'));
    }

    public function add(Request $request)
    {
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.domes.add', compact('getsportslist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sport_id' => 'required',
            'dome_name' => 'required',
            'dome_price' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'lat' => 'required',
            'description' => 'required',
            'address' => 'required',
        ], [
            'sport_id.required' => 'Please Select Sport',
            'dome_name.required' => 'Please Enter Dome Name',
            'dome_price.required' => 'Please Enter Dome Price',
            'start_time.required' => 'Please Select Dome Start Time',
            'end_time.required' => 'Please Select Dome End Time',
            'lat.required' => 'Please Choose Dome Location',
            'description.required' => 'Please Enter Dome Description',
            'address.required' => 'Please Enter Dome Address',
        ]);

        $dome = new Domes;
        $dome->vendor_id = Auth::user()->id;
        $dome->sport_id = implode(",", $request->sport_id);
        $dome->name = $request->dome_name;
        $dome->price = $request->dome_price;
        $dome->address = $request->address;
        $dome->start_time = $request->start_time;
        $dome->end_time = $request->end_time;
        $dome->description = $request->description;
        $dome->lat = $request->lat;
        $dome->lng = $request->lng;
        $dome->benefits = implode("|", $request->benefits);
        $dome->benefits_description    = $request->benefits_description;
        $dome->save();

        if ($request->has('dome_images')) {
            $request->validate([
                'dome_images' => 'required',
                'dome_images.*' => 'mimes:png,jpg,jpeg,svg',
            ], [
                'dome_images.required' => 'Please Upload Dome Images',
                'dome_images.mimes' => 'The Dome Images must be a file of type: PNG, JPG, JPEG, SVG',
            ]);
            foreach ($request->file('dome_images') as $img) {
                $domeimage = new DomeImages;
                $image = 'dome-' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move('storage/app/public/admin/images/domes', $image);
                $domeimage->vendor_id = Auth::user()->id;
                $domeimage->dome_id = $dome->id;
                $domeimage->images = $image;
                $domeimage->save();
            }
        }

        return redirect('admin/domes')->with('success', 'Added Successfully');
    }

    public function dome_details(Request $request)
    {
        $dome = Domes::with('dome_images')->find($request->id);
        $sports = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.domes.view' , compact('dome' ,'sports'));
    }

    public function edit(Request $request)
    {
        $dome = Domes::with('dome_images')->find($request->id);
        $getsportslist = Sports::where('is_available', 1)->where('is_deleted', 2)->get();
        return view('admin.domes.edit', compact('dome', 'getsportslist'));
    }

    public function update(Request $request)
    {
        dd($request->input());
        $request->validate([
            'sport_id' => 'required',
            'dome_name' => 'required',
            'dome_price' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'lat' => 'required',
            'description' => 'required',
            'address' => 'required',
        ], [
            'sport_id.required' => 'Please Select Sport',
            'dome_name.required' => 'Please Enter Dome Name',
            'dome_price.required' => 'Please Enter Dome Price',
            'start_time.required' => 'Please Select Dome Start Time',
            'end_time.required' => 'Please Select Dome End Time',
            'lat.required' => 'Please Choose Dome Location',
            'description.required' => 'Please Enter Dome Description',
            'address.required' => 'Please Enter Dome Address',
        ]);
        $dome = Domes::find($request->id);
        $dome->sport_id = implode(",", $request->sport_id);
        $dome->name = $request->dome_name;
        $dome->price = $request->dome_price;
        $dome->address = $request->address;
        $dome->pin_code = $request->pin_code;
        $dome->city = $request->city;
        $dome->state = $request->state;
        $dome->country = $request->country;
        $dome->start_time = $request->start_time;
        $dome->end_time = $request->end_time;
        $dome->description = $request->description;
        $dome->lat = $request->lat;
        $dome->lng = $request->lng;
        $dome->benefits = implode("|", $request->benefits);
        $dome->benefits_description    = $request->benefits_description;
        $dome->save();

        if ($request->has('dome_images')) {
            $request->validate([
                'dome_images' => 'required',
                'dome_images.*' => 'mimes:png,jpg,jpeg,svg',
            ], [
                'dome_images.required' => 'Please Upload Dome Images',
                'dome_images.mimes' => 'The Dome Images must be a file of type: PNG, JPG, JPEG, SVG',
            ]);
            foreach ($request->file('dome_images') as $img) {
                $domeimage = new DomeImages;
                $image = 'dome-' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move('storage/app/public/admin/images/domes', $image);
                $domeimage->vendor_id = Auth::user()->id;
                $domeimage->dome_id = $dome->id;
                $domeimage->images = $image;
                $domeimage->save();
            }
        }
        return redirect('admin/domes')->with('success', 'Updated Successfully');
    }

    public function delete(Request $request)
    {
        try {
            $checkdome = Domes::find($request->id);
            $checkdome->is_deleted = 1;
            $checkdome->save();
            return response()->json(['status' => 1, 'message' => trans('messages.success')],200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')],200);
        }
    }

    public function image_delete(Request $request)
    {
        $image = DomeImages::find($request->id);
        unlink('storage/app/public/admin/images/domes/' . $image->images);
        $image->delete();

        return 1;
    }
}
