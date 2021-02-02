<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Category;

class CategoryController extends Controller
{
    //
    public function index(){
        
        $categories= Category::take(6)->get();
        $products= Products::with('galleries')->paginate(24);
        return view('pages.category',[
            'categories'=>$categories,
            'products'=>$products
        ]);
    }

    public function detail(Request $irequest,$slug){
        
        $categories= Category::all();
        $category= Category::where('slug',$slug)->firstOrFail();
        $products= Products::with('galleries')->where('categories_id',$category->id)->paginate(24);
        return view('pages.category',[
            'categories'=>$categories,
            'products'=>$products
        ]);
    }
}
