<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviewslist = Review::where('vendor_id', Auth::user()->id)->orderByDesc('id')->get();
        return view('admin.reviews.index', compact('reviewslist'));
    }
}
