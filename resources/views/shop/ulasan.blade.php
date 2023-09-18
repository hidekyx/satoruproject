<section id="page-content">
    <div class="container">
        @if (Session::has('success'))
            <div role="alert" class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                <strong><i class="fa fa-exclamation-circle"></i>Berhasil!</strong>
                {{ Session::get('success') }}
            </div>
        @endif
        @if($transaksi->ulasan != null || $transaksi->ulasan != "")
            <div role="alert" class="alert alert-info alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                <strong><i class="fa fa-exclamation-circle"></i>Info!</strong>
                Anda sudah mengisi ulasan pada data laundry ini
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <span class="h4">Ulasan Anda</span>
                <p class="text-muted" align="right">
                {{ $no_invoice }}
                </p>
            </div>
            <div class="card-body">
                @if($transaksi->ulasan != null || $transaksi->ulasan != "")
                <form role="form" class="form-validate">
                @else
                <form role="form" class="form-validate" action="{{ asset('/ulasan/simpan/'.$transaksi->id_transaksi) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @endif
                @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="text-muted text-sm font-italic">Invoice</span>
                            <h4 class="mb-4">{{ $no_invoice }}</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <span class="text-muted text-sm font-italic">Tanggal Order</span>
                                    <h5 class="mb-4">{{ \Carbon\Carbon::parse($transaksi->created_at)->isoFormat('D MMMM Y')}}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <span class="text-muted text-sm font-italic">Tanggal Pembayaran</span>
                                    <h5 class="mb-4">{{ \Carbon\Carbon::parse($transaksi->tanggal_pembayaran)->isoFormat('D MMMM Y')}}</h5>
                                </div>
                            </div>
                            <hr>
                            @foreach($transaksi->detail as $key => $td)
                            @if($key != 0)<hr class="my-4">@endif
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="http://localhost/satoruproject/public/storage/assets/img/layout/{{ $td->item->gambar }}" alt="Image Description" class="rounded img-fluid p-1" style="height: 100%;">
                                </div>
                                <div class="col-lg-7">
                                    <h4 class="mb-0">{{ $td->item->nama_item }}</h4>
                                    <p class="d-block mb-0">Merk: {{ $td->merk }}</p>
                                    <p class="d-block">Seri: {{ $td->seri }}</p>
                                    <small class="d-block mt-2 font-weight-bold">Harga: <b class="text-success">@duit($td->item->harga)</b></small>
                                </div>
                                <div class="col-lg-2">
                                    <a title="{{ $td->item->nama_item }} - {{ $td->merk }} - {{ $td->seri }}" data-lightbox="image" href="{{ asset('storage/hasil_cuci/'.$td->foto_hasil) }}"><button type="button" class="btn btn-info btn-sm btn-roundeded">Lihat Hasil</button></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-lg-6 mt-3">
                            <p class="h4">Tulis Ulasan</p>
                            <div class="form-group">
                                @if($transaksi->ulasan != null || $transaksi->ulasan != "")
                                <textarea name="ulasan" class="form-control" placeholder="Ulasan Anda" style="width: 100%; min-height: 160px;" required disabled>{{ $transaksi->ulasan }}</textarea>
                                @else
                                <textarea name="ulasan" class="form-control" placeholder="Ulasan Anda" style="width: 100%; min-height: 160px;" required></textarea>
                                @endif
                            </div>
                            <div class=""></div>
                            <p class="h4">Berikan Rating</p>
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" required @if($transaksi->rate == 5) checked @endif>
                                <label for="star5" title="5">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" required @if($transaksi->rate == 4) checked @endif>
                                <label for="star4" title="4">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" required @if($transaksi->rate == 3) checked @endif>
                                <label for="star3" title="3">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" required @if($transaksi->rate == 2) checked @endif>
                                <label for="star2" title="2">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" required @if($transaksi->rate == 1) checked @endif>
                                <label for="star1" title="1">1 star</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group">
                            @if($transaksi->ulasan != null || $transaksi->ulasan != "")
                            <button type="submit" class="btn btn-primary disabled">Submit Ulasan</button>
                            @else
                            <button type="submit" class="btn btn-primary">Submit Ulasan</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>