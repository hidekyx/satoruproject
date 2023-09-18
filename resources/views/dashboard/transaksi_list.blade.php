<main id="main" class="main">

<div class="pagetitle">
    <h1>Data Transaksi</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Beranda</li>
        <li class="breadcrumb-item">Data Transaksi</li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
    <div class="col-lg-12">
        @if (Session::has('success'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i><strong>Berhasil!</strong>
                {{ Session::get('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i><strong>Gagal!</strong>
                {{ Session::get('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Transaksi Laundry</h5>
            <table class="table table-hover table-striped datatable">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Pengiriman</th>
                <th scope="col">Pembayaran</th>
                <th scope="col">Total Pembayaran</th>
                <th scope="col">Menu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $key => $t)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td class="text-secondary">{{ \Carbon\Carbon::parse($t->created_at)->isoFormat('D MMMM Y - H:m') }}</td>
                    @if($t->status == "Barang Diterima" || $t->status == "Proses Penjemputan")
                    <td><span class="badge badge-pill bg-info w-100">{{ $t->status }}</span></td>
                    @elseif($t->status == "Sedang Dicuci")
                    <td><span class="badge badge-pill bg-warning w-100">{{ $t->status }}</span></td>
                    @elseif($t->status == "Selesai Dicuci")
                    <td><span class="badge badge-pill bg-primary w-100">{{ $t->status }}</span></td>
                    @elseif($t->status == "Barang Sedang Diantar" || $t->status == "Barang Siap Diambil")
                    <td><span class="badge badge-pill bg-info w-100">{{ $t->status }}</span></td>
                    @elseif($t->status == "Laundry Selesai")
                    <td><span class="badge badge-pill bg-success w-100">{{ $t->status }}</span></td>
                    @endif
                    <td><b>{{ $t->user->nama }}</b></td>
                    <td class="text-secondary">
                        @php
                        $maxLength = 30;
                        
                        $alamat = preg_split("/.{0,{$maxLength}}\K(?:\s+|$)/s", $t->alamat, 0, PREG_SPLIT_NO_EMPTY);
                        echo $alamat_split = implode("<br>",$alamat);
                        
                        @endphp
                    </td>
                    <td>{{ $t->pengiriman }}</td>
                    <td>{{ $t->pembayaran }}</td>
                    <td><b class="text-success">@duit($t->total)</b></td>
                    @if($t->status == "Proses Penjemputan")
                    <td>
                        <button type="button" class="btn btn-info btn-sm w-100 rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#jemput-{{ $t->id_transaksi }}"><b><i class="bi bi-truck"></i> Jemput</b></button>
                        <div class="modal fade" id="jemput-{{ $t->id_transaksi }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Barang Jemputan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                <span class="badge badge-pill bg-info"> {{ $t->status }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Order</b></td>
                                            <td>{{ \Carbon\Carbon::parse($t->created_at)->isoFormat('D MMMM Y - H:m') }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pelanggan</b></td>
                                            <td>{{ $t->user->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Detail Barang</b></td>
                                            <td>
                                                @foreach($t->detail as $td)
                                                <p class="mb-0"><b>{{ $td->item->nama_item }}</b></p>
                                                <p class="mb-0">- Merk: {{ $td->seri }}</p>
                                                <p class="mb-0">- Seri: {{ $td->seri }}</p>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat Penjemputan</b></td>
                                            <td>{{ $t->alamat }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                    <form action="{{ asset('/dashboard/transaksi/jemput/'.$t->id_transaksi) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-info text-white"><i class="bi bi-truck"></i> Jemput Selesai</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </td>
                    @elseif($t->status == "Barang Diterima")
                    <td>
                        <button type="button" class="btn btn-warning btn-sm w-100 rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#cuci-{{ $t->id_transaksi }}"><b><i class="bi bi-cart-plus"></i> Cuci</b></button>
                        <div class="modal fade" id="cuci-{{ $t->id_transaksi }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Proses Data Transaksi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                <span class="badge badge-pill bg-info"> {{ $t->status }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Order</b></td>
                                            <td>{{ \Carbon\Carbon::parse($t->created_at)->isoFormat('D MMMM Y - H:m') }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pelanggan</b></td>
                                            <td>{{ $t->user->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Detail Barang</b></td>
                                            <td>
                                                @foreach($t->detail as $td)
                                                <p class="mb-0"><b>{{ $td->item->nama_item }}</b></p>
                                                <p class="mb-0">- Merk: {{ $td->seri }}</p>
                                                <p class="mb-0">- Seri: {{ $td->seri }}</p>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                    <form action="{{ asset('/dashboard/transaksi/cuci/'.$t->id_transaksi) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning text-white"><i class="bi bi-cart-plus"></i> Mulai Cuci</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </td>
                    @elseif($t->status == "Sedang Dicuci")
                    <td><a href="{{ asset('/dashboard/transaksi/selesai/'.$t->id_transaksi) }}"><button type="button" class="btn btn-primary btn-sm w-100 rounded-pill"><b><i class="bi bi-check2-circle"></i> Selesai</b></button></a></td>
                    @elseif($t->status == "Selesai Dicuci")
                    <td>
                        <button type="button" class="btn btn-info text-white btn-sm w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#kemas-{{ $t->id_transaksi }}"><b><i class="bi bi-box"></i> Kemas</b></button>
                        <div class="modal fade" id="kemas-{{ $t->id_transaksi }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Pengemasan Laundry</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tr>
                                            <td><b>Invoice</b></td>
                                            <td>INV/{{ str_replace('-', '', $t->tanggal_invoice ) }}/{{ $t->id_user }}/{{ $t->id_transaksi }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                <span class="badge badge-pill bg-primary"> {{ $t->status }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Order</b></td>
                                            <td>{{ \Carbon\Carbon::parse($t->created_at)->isoFormat('D MMMM Y - H:m') }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pelanggan</b></td>
                                            <td>{{ $t->user->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Detail Barang</b></td>
                                            <td>
                                                @foreach($t->detail as $td)
                                                <p class="mb-0"><b>{{ $td->item->nama_item }}</b></p>
                                                <p class="mb-0">- Merk: {{ $td->seri }}</p>
                                                <p class="mb-0">- Seri: {{ $td->seri }}</p>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                    <form action="{{ asset('/dashboard/transaksi/kemas/'.$t->id_transaksi) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-info text-white"><i class="bi bi-box"></i> Konfirmasi Pengemasan</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </td>
                    @elseif($t->status == "Barang Sedang Diantar" || $t->status == "Barang Siap Diambil")
                    <td>
                        <button type="button" class="btn btn-success btn-sm w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#bayar-{{ $t->id_transaksi }}"><b><i class="bi bi-credit-card"></i> Bayar</b></button>
                        <div class="modal fade" id="bayar-{{ $t->id_transaksi }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Pembayaran Laundry</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <tr>
                                            <td><b>Invoice</b></td>
                                            <td>INV/{{ str_replace('-', '', $t->tanggal_invoice ) }}/{{ $t->id_user }}/{{ $t->id_transaksi }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                <span class="badge badge-pill bg-primary"> {{ $t->status }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Order</b></td>
                                            <td>{{ \Carbon\Carbon::parse($t->created_at)->isoFormat('D MMMM Y - H:m') }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pelanggan</b></td>
                                            <td>{{ $t->user->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Detail Barang</b></td>
                                            <td>
                                                @foreach($t->detail as $td)
                                                <p class="mb-0"><b>{{ $td->item->nama_item }}</b></p>
                                                <p class="mb-0">- Merk: {{ $td->seri }}</p>
                                                <p class="mb-0">- Seri: {{ $td->seri }}</p>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                    <form action="{{ asset('/dashboard/transaksi/bayar/'.$t->id_transaksi) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success text-white"><i class="bi bi-credit-card"></i> Konfirmasi Pembayaran</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </td>
                    @elseif($t->status == "Laundry Selesai")
                    <td>-</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>

    </div>
    </div>
</section>

</main>