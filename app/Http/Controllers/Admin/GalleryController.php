<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductsGalleries;
use App\Products;
use App\Category;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\GalleryRequest;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{

     public function index()
    {
        if(request()->ajax()){
            $query = ProductsGalleries::with('product');
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <form action="' . route('gallery.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('photos', function ($item) {
                    return $item->photos ? '<img src="' . Storage::url($item->photos) . '" style="max-height: 80px;"/>' : '';
                })
                ->rawColumns(['action','photos'])
                ->make();}
        return view('pages.admin.gallery.index');
    }

    public function create(){
            $products= Products::all();
            return view ('pages.admin.gallery.create',['products'=>$products]);

    }
    public function store(GalleryRequest $request){
        $data= $request->all();
        //dd($request->all());
         $data['photos'] = $request->file('photos')->store('assets/product','public');
        // dd($data);
        ProductsGalleries::create($data);
        return redirect()->route('gallery.index');
        
    }

    public function destroy($id){
        $items= ProductsGalleries::findOrFail($id);
        $items->delete();

        return redirect()->route('gallery.index');

    }
   
}
