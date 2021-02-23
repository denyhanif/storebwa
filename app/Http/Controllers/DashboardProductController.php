<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\User;
use App\Category;
use App\ProductsGalleries;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\ProductRequest;


use Auth;
class DashboardProductController extends Controller
{
    public function index(){
        $products = Products::with(['galleries','category'])->where('user_id',Auth::user()->id)->get();
        //dd($product);
        return view ('pages.dashboard-products',[
            'products'=>$products
        ]);
    }
    // public function details($id){

    //     $products = Products::with(['galleries','category'])->where('id',$id)->get();

    //     return view('pages.dashboard-products-detail',[
    //         'products'=>$products
    //     ]);
    // }

    public function create(){
        $categories= Category::all();
        return view ('pages.dashboard-products-create',['categories'=>$categories]);
    }
    public function store(Request $request){
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $product = Products::create($data);
        $gallery= [
            'products_id'=> $product->id,
            'photos'=> $request->file('photos')->store('assets/product','public')
        ];

        ProductsGalleries::create($gallery);
        
        return redirect()->route('dashboard-product');
    }
    // public function details($id){

    //     $products = Products::with(['galleries','category'])->where('id',$id)->get();

    //     return view('pages.dashboard-products-detail',[
    //         'products'=>$products
    //     ]);
    // }


    public function details(Request $request,$id){
        $product = Products::with(['galleries','users','category'])->findOrFail($id);
        $categories = Category::all();

         return view('pages.dashboard-products-detail',[
            'product'=>$product,
            'categories'=>$categories
        ]);
    }
    public function uploadGallery(Request $request){
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product','public');
        ProductsGalleries::create($data);
        return redirect()->route('dashboard-product-details',$request->products_id);
    }

    public function deleteGallery($id){
        $data = ProductsGalleries::findOrFail($id);
        $data->delete();
        return redirect()->route('dashboard-product-details', $data->products_id);
    }
    public function update(ProductRequest $request,$id){
        $data= $request->all();
        $item = Products::findOrFail($id);
        $data['slug'] = Str::slug($request->name);
        $item->update($data);
        return redirect()->route('dashboard-product');
    }
      
}
