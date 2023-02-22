<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DomesPriceController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.set_prices.index');
    }
    public function add(Request $request)
    {
        return view('admin.set_prices.add');
    }
    public function edit(Request $request)
    {
        return view('admin.set_prices.edit');
    }
    public function dome_price_details(Request $request)
    {
        return view('admin.set_prices.view');
    }
}
