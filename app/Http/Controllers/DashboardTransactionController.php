<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionDetail;
use Auth;


class DashboardTransactionController extends Controller
{
    public function index(){

        
         $transactions= TransactionDetail::with(['transaction.user','product.galleries'])
        ->whereHas('product', function($product){
            $product->where('user_id',Auth::user()->id);
        })->get();
        // $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
        //                     ->whereHas('product', function($product){
        //                         $product->where('users_id', Auth::user()->id);
        //                     })->get();
        // dd($transactions);
        $buyTransaction = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('transaction',function($transaction){
                                $transaction->where('users_id',Auth::user()->id);
                            })->get();
        return view('pages.dashboard-transactions',[
            'transactions' =>$transactions,
            'buyTransaction' =>$buyTransaction
        ]);
    }

    public function details(Request $request,$id){
        $transaction =TransactionDetail::with(['transaction.user','product.galleries'])
                        ->findOrFail($id);


        return view('pages.dashboard-transactions-details',[
            'transaction'=>$transaction
        ]);
    }

    public function update(Request $request,$id){
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);
        $item->update($data);
        return redirect()->route('dashboard-transaction-detail',$id);
    }

}
