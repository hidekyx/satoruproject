<main id="main" class="main">

<div class="pagetitle">
    <h1>Data Ulasan</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Beranda</li>
        <li class="breadcrumb-item">Data Ulasan</li>
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
            <h5 class="card-title">Data Ulasan</h5>
            <hr>
            <table class="table table-hover table-striped datatable">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Invoice</th>
                <th scope="col">Tanggal Pembayaran</th>
                <th scope="col">Akun / Email</th>
                <th scope="col">Detail Laundry</th>
                <th scope="col">Ulasan</th>
                <th scope="col">Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($review as $key => $r)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td><b>INV/{{ str_replace('-', '', $r->tanggal_invoice) }}/{{ $r->id_user."/".$r->id_transaksi }}</b></td>
                    <td>{{ \Carbon\Carbon::parse($r->tanggal_pembayaran)->isoFormat('D MMMM Y') }}</td>
                    <td class="text-secondary">{{ $r->user->email }}</td>
                    <td>
                        @foreach($r->detail as $d)
                        <p class="mb-0"><b>{{ $d->item->nama_item }}</b></p>
                        <p class="mb-0">- Merk: {{ $d->seri }}</p>
                        <p class="mb-0">- Seri: {{ $d->seri }}</p>
                        @endforeach
                    </td>
                    <td class="text-secondary">
                        @php
                        $maxLength = 30;
                        
                        $ulasan = preg_split("/.{0,{$maxLength}}\K(?:\s+|$)/s", $r->ulasan, 0, PREG_SPLIT_NO_EMPTY);
                        echo $ulasan_split = implode("<br>",$ulasan);
                        
                        @endphp
                    </td>
                    <td>
                        <div class="text-warning">
                            @for($i=0; $i < $r->rate; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                    </td>
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