<section id="shop-cart">
    <div class="container">
        <div class="shop-cart">
            @if (Session::has('error'))
                <div role="alert" class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                    <strong><i class="fa fa-exclamation-circle"></i> Gagal!</strong>
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div role="alert" class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                    <strong><i class="fa fa-check-circle"></i> Berhasil!</strong>
                    {{ Session::get('success') }}
                </div>
            @endif
            <form role="form" class="form-validate" action="{{ asset('/keranjang/checkout') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
            @csrf
                <div class="table table-sm table-striped table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="cart-product-remove"></th>
                                <th class="cart-product-thumbnail"></th>
                                <th class="cart-product-nama">Nama Barang</th>
                                <th class="cart-product-deskripsi">Deskripsi</th>
                                <th class="cart-product-harga">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keranjang as $k)
                            <tr>
                                <td class="cart-product-remove">
                                    <a href="{{ asset('/keranjang/hapus/'.$k->id_keranjang) }}"><i class="fa fa-times text-danger"></i></a>
                                </td>
                                <td class="cart-product-thumbnail">
                                    <a href="#">
                                        <img src="{{ asset('storage/assets/img/layout/'.$k->item->gambar) }}" alt="">
                                    </a>
                                </td>
                                <td class="cart-product-nama">
                                    <div class="cart-product-thumbnail-name">{{ $k->item->nama_item }}</div>
                                </td>
                                <td class="cart-product-deskripsi">
                                    <p><span>Merk / Brand: {{ $k->merk }}</span><br>
                                        <span>Tipe / Series: {{ $k->seri }}</span><br>
                                    </p>
                                </td>
                                <td class="cart-product-harga">
                                    <span class="amount">@duit($k->item->harga)</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <hr class="space">
                    <div class="col-lg-3">
                        <div class="row">
                            <h4>Pengiriman Pesanan</h4>
                            <div class="form-group">
                                <select class="form-select" name="pengiriman" onChange="pengirimanFunction(this.options[this.selectedIndex].value)" required>
                                    <option selected value="Datang ke Toko">Datang ke Toko</option>
                                    <option value="Jemput & Antar">Jemput & Antar</option>
                                </select>
                                <script>
                                    function pengirimanFunction(value) {
                                        if(value == "Jemput & Antar") {
                                            document.getElementById('alamat').removeAttribute("disabled");
                                            document.getElementById('pengiriman').innerHTML = value;
                                        }
                                        else if (value == "Datang ke Toko") {
                                            document.getElementById('alamat').setAttribute("disabled", true);
                                            document.getElementById('alamat').value = "";
                                            document.getElementById('pengiriman').innerHTML = value;
                                        }
                                    }
                                </script>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Isikan alamat rumah" rows="3" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="row">
                            <h4>Pembayaran</h4>
                            <div class="form-group">
                                <select class="form-select" name="pembayaran" onChange="pembayaranFunction(this.options[this.selectedIndex].value)" required>
                                    <option selected value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                                <script>
                                    function pembayaranFunction(value) {
                                        document.getElementById('pembayaran').innerHTML = value;
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-r-10 ">
                        <div class="table-responsive">
                            <h4>Rincian Pesanan</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="cart-product-name">
                                            <strong>Pengiriman</strong>
                                        </td>
                                        <td class="cart-product-name  text-end">
                                            <span class="amount" id="pengiriman">Datang ke Toko</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-name">
                                            <strong>Pembayaran</strong>
                                        </td>
                                        <td class="cart-product-name  text-end">
                                            <span class="amount" id="pembayaran">Cash on Delivery</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-name">
                                            <strong>Total</strong>
                                        </td>
                                        <td class="cart-product-name text-end">
                                            <span class="amount color lead"><strong>@duit($total_harga)</strong></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn icon-left float-right btn-info" type="submit"><span>Checkout</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>