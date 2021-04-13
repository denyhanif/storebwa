@extends('layouts.admin')

@section('title')
   Admin edit Transaksi
@endsection

@section('content')
        <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
        >
            <div class="container-fluid">
                <div class="dashboard-heading">
                <h2 class="dashboard-title">Edit Transaksi</h2>
                <p class="dashboard-subtitle">
                    Edit transaksi {{ $item->user->name  }}
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
                                <form action="{{ route('transaction.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status Transaksi</label>
                                                <select name="transactions_status" class="form-control" required>
                                                    <option value="{{ $item->transactions_status }}" selected>{{ $item->transactions_status }}</option>
                                                    <option value="" disabled>-------</option>
                                                    <option value="PENDING">PENDING</option>
                                                    <option value="SUCCESS">SUCCESS</option>
                                                    <option value="SHIPPING">SHIPPING</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Harga</label>
                                                <input type="text" name="total_price" class="form-control" value="{{ $item->total_price }}" required>
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