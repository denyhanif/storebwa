<?php

namespace App\Http\Controllers;

use App\Chart;
use App\Transaction;
use App\TransactionDetail;

use Exception;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Auth;

class CheckoutController extends Controller
{
    public function process(Request $request){

        //simpan data user
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proses cekout
        $code = 'STORE'.mt_rand(00000,99999);
        $carts = Chart::with(['product','user'])
                ->where('user_id', Auth::user()->id)
                ->get();

        // masukkan dat ake tabek transaksi
        $transaction = Transaction::create([
            'users_id'=> Auth::user()->id,
            'insurance_price'=>0,
            'shipping_price'=>0,
            'total_price'=> $request->total_price,
            'transactions_status'=>'PENDING',
            'code'=>$code,   
        ]);

        //tambah ke transaction detail tabel
        foreach($carts as $cart){
            $trx = 'TRX-' .mt_rand(0000,9999);
            TransactionDetail::create([
                'transactions_id'=>$transaction->id,
                'products_id'=>$cart->product->id,
                'price'=>$cart->product->price,
                'shipping_status'=>'PENDING',
                'resi'=>'',
                'code'=>$trx
            ]);
        }
// Set your Merchant Server Key
Config::$serverKey = 'SB-Mid-server-PKYop-64YDmFYXDss9znh7L6';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
Config::$isProduction = false;
// Set sanitization on (default)
Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
Config::$is3ds = true;
        // //konfigurasi midtrans
        // Config::$serverKey = config('services.midtrans.serverKey');
        // //Config::$clientKey = config('service.midtrans.clientKey');
        // Config::$isProduction= config('services.midtrans.isProduction');
        // Config::$isSanitized= config('services.midtrans.isSanitized');
        // Config::$is3ds = config('services.midtrans.is3ds');

        //aray yg di kirim ke midtrans
        $midtrans = [
            'transaction_details'=>[
                'order_id'=>$code,
                'gross_amount'=> (int)$request->total_price,
            ],
            'customer_details'=>[
                'first_name'=>Auth::user()->name,
                'email'=>Auth::user()->email,
            ],
            'enabled_payments'=>[
                'gopay','permata_va','bank_transfer'
            ],
            'vtweb'=>[]
        ];

        try{
            //Get snap payment url
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            //redirect to snap payment page
            return redirect($paymentUrl);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }


    }
    public function callback(Request $request){
        
    }
}
