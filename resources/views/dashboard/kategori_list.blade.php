<main id="main" class="main">

<div class="pagetitle">
    <h1>Data Kategori Barang</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Beranda</li>
        <li class="breadcrumb-item">Data Kategori Barang</li>
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
            <h5 class="card-title">Data Kategori Barang</h5>
            <a href="{{ asset('/dashboard/kategori/tambah') }}"><button type="button" class="btn btn-primary btn-sm text-white rounded-pill"><b><i class="bi bi-plus-lg"></i> Tambah</b></button></a>
            <hr>
            <table class="table table-hover table-striped datatable">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Item</th>
                <th scope="col">Harga</th>
                <th scope="col">Kategori</th>
                <th scope="col">Ilustrasi</th>
                <th scope="col">Menu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item as $key => $i)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $i->nama_item }}</td>
                    <td class="text-success"><b>@duit($i->harga)</b></td>
                    <td>{{ $i->kategori }}</td>
                    <td><img src="{{ asset('storage/assets/img/layout/'.$i->gambar) }}" style="border-radius: 5px; max-width: 60px;"></td>
                    <td style="width: 100px;"><a href="{{ asset('/dashboard/kategori/edit/'.$i->id_item) }}"><button type="button" class="btn btn-warning btn-sm text-white rounded-pill"><b><i class="bi bi-pencil-square"></i> Edit</b></button></a></td>
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