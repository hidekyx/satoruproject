<section id="page-content">
    <div class="container">
        <div class="row">
            <div class="content col-lg-12">
                 @if (Session::has('success'))
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                        <strong><i class="fa fa-exclamation-circle"></i>Berhasil!</strong>
                        {{ Session::get('success') }}
                    </div>
                @endif
                <h4>Riwayat Transaksi Laundry</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-responsive">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Detail Barang</th>
                                <th scope="col">Pengiriman</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col">Total Pembayaran</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $key => $t)
                                <tr>
                                    <td scope="row"><b>{{ $key+1 }}</b></td>
                                    <td scope="row">
                                        <h5 class="mb-1">Tanggal Order:</h5>
                                        {{ \Carbon\Carbon::parse($t->created_at)->isoFormat('D MMMM Y - H:m')}}
                                        <hr>
                                        <h5 class="mb-1">Tanggal Invoice:</h5>
                                        {{ \Carbon\Carbon::parse($t->tanggal_invoice)->isoFormat('D MMMM Y')}}
                                        <a href="{{ asset('/invoice/'.$t->id_transaksi) }}"><button type="button" class="btn btn-success btn-roundeded mt-2 w-100"><i class="fa fa-receipt"></i> Lihat Invoice</button></a>
                                        <hr>
                                        <h5 class="mb-1">Tanggal Pembayaran:</h5>
                                        {{ \Carbon\Carbon::parse($t->tanggal_pembayaran)->isoFormat('D MMMM Y')}}<br>
                                        <a href="{{ asset('/ulasan/'.$t->id_transaksi) }}"><button type="button" class="btn btn-warning btn-roundeded mt-2 btn-sm"><i class="fa fa-pen-square"></i> Tulis Ulasan</button></a>
                                    </td>
                                    <td scope="row">
                                        @foreach($t->detail as $key => $td)
                                        @if($key != 0)<hr>@endif
                                        <ul class="list-icon list-icon-arrow list-icon-colored">
                                            <li>
                                                <h5 class="mb-1">{{ $td->item->nama_item }}</h5>
                                                Merk: <small class="text-muted">{{ $td->merk }}</small><br>
                                                Seri: <small class="text-muted">{{ $td->seri }}</small><br>
                                                Harga: <small class="text-success">@duit($td->item->harga)</small><br>
                                                <a title="{{ $td->item->nama_item }} - {{ $td->merk }} - {{ $td->seri }}" data-lightbox="image" href="{{ asset('storage/hasil_cuci/'.$td->foto_hasil) }}"><button type="button" class="btn btn-info btn-sm btn-roundeded">Lihat Hasil</button></a>
                                            </li>
                                        </ul>
                                        @endforeach
                                    </td>
                                    <td scope="row">{{ $t->pengiriman }}</td>
                                    <td scope="row">{{ $t->pembayaran }}</td>
                                    <td scope="row"><b class="text-success">@duit($t->total)</b></td>
                                    <td scope="row"><span class="badge w-100 badge-sm bg-success">{{ $t->status }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="shop-cart" class="background-dark" style="height: 25vh;">
    <div class="container">
        <div class="text-center">
            <div class="heading-text heading-line text-center">
                <h4 class="text-white">Tracking Laundry Anda</h4>
            </div>
            <a class="btn icon-left btn-info" href="{{ asset('/tracking/list') }}"><span>Lihat</span></a>
        </div>
    </div>
</section>