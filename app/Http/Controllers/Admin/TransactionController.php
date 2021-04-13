<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index(){

        if(request()->ajax()){
            $query = Transaction::with(['user']);
            return Datatables::of($query)
            ->addColumn('action',function($item){
                return'
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" 
                                    id="action'.$item->id.'" 
                                    data-toggle="dropdown" 
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    Aksi
                            </button>
                            <div class="dropdown-menu" aria-labelledby="action'.$item->id.'">
                                <a class="dropdown-item" href="'.route('transaction.edit',$item->id).'">
                                    Sunting
                                </a>
                                <form action="'.route('transaction.destroy',$item->id).'" method="POST" >
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="dropdown-item text-danger >
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action'])->make();
        }
        return view('pages.admin.transaction.index');

    }

    public function create(){}

    public function store(Request $request){

    }

    public function edit($id){
        $item = Transaction::with(['user'])->findOrFail($id);
        return view('pages.admin.transaction.edit',['item'=>$item]);
    }
    public function update(Request $request,$id){
        $data =$request->all();
        $item = Transaction::findOrFail($id);
        $item->update($data);

        return redirect()->route('transaction.index');
    }
    public function destroy($id){
        $item = Transaction::findOrFail($id);
        $item->delete();

        return redirect()->route('transaction.index');
    }
}
