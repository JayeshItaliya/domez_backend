<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->id == 1) {
            $transactions = Transaction::where('user_id','!=','')->orderByDesc('id')->get();
        } else {
            $transactions = Transaction::where('user_id','!=','')->where('vendor_id', auth()->user()->id)->orderByDesc('id')->get();
        }
        return view('admin.transactions.index', compact('transactions'));
    }
    public function details(Request $request)
    {
        return view('admin.transactions.details');
    }
}
?>
