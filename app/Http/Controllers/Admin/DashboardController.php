<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Transaction;

class DashboardController extends Controller
{
     public function index(){
        $customer = User::count();
        $revenue = Transaction::sum('total_price');
        //$revenue= Transaction::where('transaction_status,'Success)->sum('total_price');
        $transaction= Transaction::count();//hitung jumlah semua transaction

        return view('pages.admin.dashboard',[
            'customer'=> $customer,
            'revenue'=>$revenue,
            'transaction'=>$transaction 
        ]);
    }
}
