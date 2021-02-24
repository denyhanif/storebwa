    @extends('layouts.app')
    @section('title')
        Keranjang Belanja 
    @endsection

    @section('content')
        <div class="page-content page-cart">
        <section
            class="store-breadcrumbs"
            data-aos="fade-down"
            data-aos-delay="100"
        >
            <div class="container">
            <div class="row">
                <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Keranjang Belanja
                    </li>
                    </ol>
                </nav>
                </div>
            </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-12 table-responsive">
                <table
                    class="table table-borderless table-cart"
                    aria-describedby="Cart"
                >
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name &amp; Seller</th>
                            <th scope="col">Price</th>
                            <th scope="col">Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_price=0
                        @endphp
                        @foreach ($charts as $chart)
                        <tr>
                            <td style="width: 25%;">
                                @if($chart->product->galleries)
                                <img
                                    src="{{ Storage::url($chart->product->galleries->first()->photos) }}"
                                    alt=""
                                    class="cart-image"
                                />
                                @endif
                            </td>
                            <td style="width: 35%;">
                                <div class="product-title">{{ $chart->product->name }}</div>
                                <div class="product-subtitle">{{ $chart->product->users->store_name }}</div>
                            </td>
                                <td style="width: 35%;">
                                <div class="product-title">{{ $chart->product->price }}</div>
                                {{--  <div class="product-subtitle">{{ $chart->product->description }}</div>  --}}
                            </td>
                            <td style="width: 20%;">
                                <form action="{{ route('cart-delete', $chart->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-remove-cart" type="submit">
                                            Remove
                                        </button>
                                </form>        
                            </td>
                        </tr>  
                        @php
                            $total_price+= $chart->product->price
                        @endphp
                        @endforeach
                       

                    </tbody>
                </table>
                </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                <hr />
                </div>
                <div class="col-12">
                <h2 class="mb-4">Detail Pengiriman</h2>
                </div>
            </div>
            <form action="{{ route('checkout') }}" method="POST" id="locations">
                @csrf
                <input type="hidden" name="total_price" value="{{ $total_price }}">
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Alamat 1</label>
                                <input
                                type="text"
                                class="form-control"
                                id="addressOne"
                                aria-describedby="emailHelp"
                                name="address_one"
                                value=""
                                />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_two">Alamat 2</label>
                            <input
                            type="text"
                            class="form-control"
                            id="address_two"
                            aria-describedby="emailHelp"
                            name="addressTwo"
                            value=""
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinces_id">Province</label>
                            <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id" v-if="provinces">
                            <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                             </select>
                             <select v-else class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label for="regencies_id">City</label>
                            <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                                <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
                            </select>
                            <select v-else class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Kode Pos</label>
                            <input
                            type="text"
                            class="form-control"
                            id="zip_code"
                            name="zip_code"
                            value="40512"
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input
                            type="text"
                            class="form-control"
                            id="country"
                            name="country"
                            value="Indonesia"
                            />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Mobile</label>
                            <input
                            type="text"
                            class="form-control"
                            id="phone_number"
                            name="phone_number"
                            value="+628 2020 11111"
                            />
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                    <hr />
                    </div>
                    <div class="col-12">
                    <h2>Informasi Pembayaran</h2>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-4 col-md-2">
                    <div class="product-title">$0</div>
                    <div class="product-subtitle">Country Tax</div>
                    </div>
                    <div class="col-4 col-md-3">
                    <div class="product-title">$0</div>
                    <div class="product-subtitle">Asuransi</div>
                    </div>
                    <div class="col-4 col-md-2">
                    <div class="product-title">$0</div>
                    <div class="product-subtitle">Potongan</div>
                    </div>
                    <div class="col-4 col-md-2">
                    <div class="product-title text-success">${{ $total_price??'0' }}</div>
                    <div class="product-subtitle">Total</div>
                    </div>
                    <div class="col-8 col-md-3">
                    <button type="submit"class="btn btn-success mt-4 px-4 btn-block">
                        Bayar Sekarang
                    </button>
                    </div>
                </div>
            </form>

            </div>
        </section>
        </div>
    @endsection
@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
            AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
              .then(function (response) {
                  self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
              .then(function (response) {
                  self.regencies = response.data;
              })
          },
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
          },
        }
      });
    </script>
@endpush