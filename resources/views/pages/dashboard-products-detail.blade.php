@extends('layouts.dashboard')

@section('title')
    Dashboard products Details
@endsection

@section('content')
<div id="page-content-wrapper">
          <nav class="navbar navbar-store navbar-expand-lg navbar-light fixed-top" data-aos="fade-down">
            {{--  <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle" >
              &laquo; Menu
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>  --}}

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              {{--  <ul class="navbar-nav ml-auto d-none d-lg-flex">
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <img src="/images/icon-user.png" alt="" class="rounded-circle mr-2 profile-picture" />
                    Hi, Angga
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/index.html">Back to Store</a>
                    <a class="dropdown-item" href="/dashboard-account.html" >Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/">Logout</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-inline-block mt-2" href="#">
                    <img src="{{asset('/images/icon-cart-empty.svg')}}" alt="" />
                  </a>
                </li>
              </ul>  --}}
              <!-- Mobile Menu -->
              <ul class="navbar-nav d-block d-lg-none mt-3">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <img src="{{ asset('/images/icon-user.png') }}" alt="" class="rounded-circle mr-2 profile-picture" />
                    Halo, {{ Auth::user()->name }}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-inline-block" href="{{ route('cart') }}">
                    Cart
                  </a>
                </li>
              </ul>
            </div>
          </nav>

          <div class="section-content section-dashboard-home" data-aos="fade-up">
           
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Shirup Marzan</h2>
                <p class="dashboard-subtitle">
                  Product Details
                </p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                    <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="{{ $product->name }}"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price"  aria-describedby="price" name="price" value="{{ $product->price }}"/>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="category">Category</label>
                                <select name="categories_id" id="category" class="form-control">
                                  <option value="{{ $product->categories_id }}"> Tidak diganti{{ $product->category->nama }}</option>
                                  @foreach ($categories as $categories)
                                     <option value="{{ $categories->id }}">{{ $categories->nama }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="editor" cols="30" rows="4" class="form-control editor"/> {{ $product->description }}
                                </textarea>
                              </div>
                            </div>
                            <div class="col">
                              <button type="submit" class="btn btn-success btn-block px-5">
                                Update Product
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          @foreach ($product->galleries as $galleries)
                          <div class="col-md-4">
                            <div class="gallery-container">
                              <img
                                src="{{ Storage::url($galleries->photos ?? '') }}"
                                alt=""
                                class="w-100"
                              />
                              <a class="delete-gallery" href="{{ route('dashboard-delete-gallery',$galleries->id) }}">
                                <img src="/images/icon-delete.svg" alt="" />
                              </a>
                            </div>
                          </div>              
                          @endforeach
                        
                          <div class="col col-12 mt-3">
                            <form action="{{ route('dashboard-upload-gallery') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="products_id" value="{{ $product->id }}">
                              <input
                              type="file"
                              id="file"
                              style="display: none;"
                              multiple
                              name="photos"
                              onchange="form.submit()"
                              />
                              <button type="button"
                              class="btn btn-secondary btn-block"
                              onclick="thisFileUpload();"
                              >
                              Add Photo
                            </button>
                            </form>
                            
                            
                          </div>
                        </div>
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
  <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script>
      function thisFileUpload() {
        document.getElementById("file").click();
      }
    </script>
    <script>
      CKEDITOR.replace("editor")
    </script>
@endpush