<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\UserRequest;


class UserController extends Controller
{
    public function index(){
     if(request()->ajax()){   
        $query = User::query();

        return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                    <div class=" btn-group">
                        <div class="dropdown"> 
                            <button class=" btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="'. route('user.edit',$item->id).'">
                                    Sunting
                                </a>
                                <form action="'. route('user.destroy',$item->id).'" method="POST">
                                 '.method_field('delete').csrf_field().'
                                    <button type="submit" class="dropdown-item text-danger"> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->make();      
    }
    return view('pages.admin.user.index'); 
    }

    public function create(){
        return view ('pages.admin.user.create');
    }

    public function store(UserRequest $request){
         
        $data= $request->all();
        $data['password']= bcrypt($request->password);

        User::create($data);

        return redirect()->route('user.index');

    }

    public function show(){

    }

    public function edit($id){
        $item = User::findOrFail($id);
        return view('pages.admin.user.edit',['item'=>$item]);
    }
     public function destroy($id)
    {
        $items= User::findOrFail($id);
        $items->delete();

        return redirect()->route('user.index');
    }
    public function update(UserRequest $request, $id)
    {
        $data= $request->all();
        //dd($request->all());
        $item= User::findOrfail($id);

        if($request->password){
            $data['password']= bcrypt($request->password);
        }else{
            unset($data['password']);
        }

        $item->update($data);

        return redirect()->route('user.index');
    }
}
