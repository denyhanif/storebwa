@extends('layouts.admin')

@section('title')
   Selamat datang admin BWASTORE
@endsection

@section('content')
        <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
        >
            <div class="container-fluid">
                <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">
                    Look what you have made today!
                </p>
                </div>
                <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                        <div class="dashboard-card-title">
                            Customer
                        </div>
                        <div class="dashboard-card-subtitle">
                          {{ $customer }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">
                          Revenue
                        </div>
                        <div class="dashboard-card-subtitle">
                          {{ $revenue }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">
                          Transaction
                        </div>
                        <div class="dashboard-card-subtitle">
                          {{ $transaction }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 mt-2">
                    <h5 class="mb-3">Transaksi Terbaru</h5>
                    @foreach ($recent as $item)
                      <div class="card card-list d-block" aria-disabled="true" href=""
                    >
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img
                              src="/images/dashboard-icon-product-1.png"
                              alt=""
                            />
                          </div>
                          <div class="col-md-4">
                            {{$item->product->name}}
                          </div>
                          <div class="col-md-3">
                            {{ $item->transaction->users_id }}
                          </div>
                          <div class="col-md-3">
                            {{ $item->transaction->created_at }}
                          </div>
                          <div class="col-md-1 d-none d-md-block">
                            <img
                              src="/images/dashboard-arrow-right.svg"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    @endforeach
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection