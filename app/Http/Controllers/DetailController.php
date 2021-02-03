<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Chart;
use Auth;

class DetailController extends Controller
{
    public function index(Request $request, $id){
        $products = Products::with(['users','galleries'])->where('slug',$id)->firstOrFail();
        return view('pages.detail',[
            'products'=>$products
        ]);
    }
    public function addChart(Request $request,$id){
        $data = [
            'products_id'=>$id,
            'user_id'=>Auth::user()->id,
        ];

        Chart::create($data);
        return redirect()->route('cart');

    }
    
}
