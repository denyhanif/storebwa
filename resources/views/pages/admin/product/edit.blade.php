@extends('layouts.admin')

@section('title')
   Admin edit kategori
@endsection

@section('content')
        <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
        >
            <div class="container-fluid">
                <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">
                    Buat kategori baru
                </p>
                </div>
                <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('produk.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pemilik Produk</label>
                                                <select name="user_id" class="form-control" required>
                                                    <option value="{{ $item->user_id }}" selected>{{ $item->users->name }}</option>
                                                    @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select name="categories_id" class="form-control" required>
                                                    <option value="{{ $item->category_id }}" selected>{{ $item->category->nama }}</option>

                                                    @foreach ($category as $category)
                                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Harga</label>
                                                <input type="number" name="price" class="form-control" value="{{ $item->price }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Deskripsi</label>
                                                <textarea name="description" id="editor" cols="30" rows="10" >{{ !! $item->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
@endsection
@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>          
<script>
              CKEDITOR.replace('editor');
</script>
    
@endpush