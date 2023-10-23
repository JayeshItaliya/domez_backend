<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
class AdminController extends Controller
{
    public function optimize(Request $request)
    {
        // Artisan::call('optimize:clear');
        // Artisan::call('optimize');

        if (file_exists(storage_path('logs/laravel.log'))) {
            unlink(storage_path('logs/laravel.log'));
        }
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        return response()->json(["status" => 1, "message" => "Successful"], 200);
    }
}
