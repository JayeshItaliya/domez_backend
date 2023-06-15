<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
class AdminController extends Controller
{
    public function optimize(Request $request)
    {
        Artisan::call('optimize:clear');
        Artisan::call('optimize');
        return response()->json(["status" => 1, "message" => "Successful"], 200);
    }
}
