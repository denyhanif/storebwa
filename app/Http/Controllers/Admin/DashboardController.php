<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use App\TransactionDetail;

class DashboardController extends Controller
{
     public function index(){
        $customer = User::count();
        $revenue = Transaction::sum('total_price');
        //$revenue= Transaction::where('transaction_status,'Success)->sum('total_price');
        $transaction= TransactionDetail::count();
        $recent = TransactionDetail::with(['product','transaction'])->get();//hitung jumlah semua transaction
        
        return view('pages.admin.dashboard',[
            'customer'=> $customer,
            'revenue'=>$revenue,
            'transaction'=>$transaction,
            'recent'=>$recent 
        ]);
    }
}
