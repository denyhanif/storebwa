<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Products;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\ProductRequest;



class ProductController extends Controller
{
    public function index(){
        
        if(request()->ajax()){
        $query = Products::with(['users','category']);

        return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                    <div class=" btn-group">
                        <div class="dropdown"> 
                            <button class=" btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="'. route('produk.edit',$item->id).'">
                                    Sunting
                                </a>
                                <form action="'. route('produk.destroy',$item->id).'" method="POST">
                                 '.method_field('delete').csrf_field().'
                                    <button type="submit" class="dropdown-item text-danger"> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->make();}
            return view('pages.admin.product.index');
    }
    public function create(){

        $users= User::all();
        $categories = Category::all();
        
        return view('pages.admin.product.create',[
            'users'=>$users,
            'categories'=>$categories,
        ]);


    }
    public function store(ProductRequest $request){
        $data= $request->all();
        //dd($request->all());
        $data['slug']= Str::slug($request->name);
        Products::create($data);
        dd($data);
        return redirect()->route('produk.index');
    }

    public function destroy($id){
        $items= Products::findOrFail($id);
        $items->delete();

        return redirect()->route('produk.index');   
     }
     public function edit($id){
         $item= Products::findOrFail($id);
         $users = User::all();
         $category= Category::all();
         return view('pages.admin.product.edit',[
             'item'=>$item,
              'users'=>$users,
              'category'=>$category]);
     }

     public function update(ProductRequest $request,$id){

        $data= $request->all();
        $item= Products::findOrFail($id);
        $data['slug']= Str::slug($request->name);
        $item->update($data);
        return redirect()->route('produk.index');


     }

    
    
}
