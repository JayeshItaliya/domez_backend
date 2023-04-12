<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviewslist = Review::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->orderByDesc('id')->get();
        return view('admin.reviews.index', compact('reviewslist'));
    }
    public function replymessage(Request $request)
    {
        $reviewdata = Review::find($request->id);
        if(!empty($reviewdata)){
            $reviewdata->reply_message = $request->reply;
            $reviewdata->replied_at = date('Y-m-d');
            $reviewdata->save();
            return redirect('admin/reviews')->with('success',trans('messages.success'));
        }
        return redirect('admin/reviews')->with('error',trans('messages.wrong'));
    }
}
