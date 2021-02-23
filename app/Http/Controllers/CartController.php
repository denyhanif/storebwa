<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chart;
use Auth;
class CartController extends Controller
{
    public function index(){
        $charts=Chart::with(['product.galleries','user'])
                ->where('user_id',Auth::user()->id)
                ->get();
        return view('pages.cart',['charts'=>$charts]);
        dd($charts);
    }

    public function delete(Request $request,$id){
        $data= Chart::findOrFail($id);
        $data->delete();

        return redirect()->route('cart');
    }

    public function success(){
        return view('pages.success');
    }
}
