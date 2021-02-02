<?php

namespace App\Http\Controllers;

use App\Category;
use App\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function index()
    {   
        $categories= Category::take(6)->get();
        $products= Products::with('galleries')->take(8)->get();
        return view('pages.home',[
            'categories'=>$categories,
            'products'=>$products
        ]);
    }
}
