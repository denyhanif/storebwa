@extends('layouts.admin')

@section('title')
   Produk
@endsection

@section('content')
        <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
        >
            <div class="container-fluid">
                <div class="dashboard-heading">
                <h2 class="dashboard-title">Produk</h2>
                <p class="dashboard-subtitle">
                    Daftar Produk
                </p>
                </div>
                <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3"> Tambah Produk+</a>
                                <div class="table-resposive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Pemilik</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
    <script>
        
        var datatable = $('#crudTable').DataTable({
            processing: false,
            serverSide: false,
            ordering: true,
            ajax:{
                url:'{!! url()->current() !!}'
            },
            columns:[
                {data:'id', name:'id'},
                {data:'name', name:'name'},
                {data:'users.name', name:'users.name'},
                {data:'price',name:'price'},
                {data:'category.nama', name:'category.nama'},
                {data:'action', name:'action',orderable: false, searchable:false, width:'15%'},
             ],
        })
    </script>
    
@endpush