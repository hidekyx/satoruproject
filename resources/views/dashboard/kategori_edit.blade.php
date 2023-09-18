<main id="main" class="main">

<div class="pagetitle">
    <h1>Data Kategori Barang</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Beranda</li>
        <li class="breadcrumb-item">Data Kategori Barang</li>
        <li class="breadcrumb-item active">Edit Barang</li>
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
            <h5 class="card-title mb-3 pb-0">Edit Item</h5>
            <form action="{{ asset('/dashboard/kategori/edit_action/'.$item->id_item) }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row mb-3">
                    <label for="nama_item" class="col-lg-2 col-form-label">Nama Item</label>
                    <div class="col-lg-10">
                        <input name="nama_item" type="text" class="form-control" id="nama_item" value="{{ $item->nama_item }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="harga" class="col-lg-2 col-form-label">Harga Item</label>
                    <div class="col-lg-10">
                        <input name="harga" type="number" class="form-control" id="harga" value="{{ $item->harga }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="harga" class="col-lg-2 col-form-label">Kategori Item</label>
                    <div class="col-lg-10">
                        <select class="form-select" name="kategori" required>
                            <option selected hidden value="{{ $item->kategori }}">{{ $item->kategori }}</option>
                            <option value="Sepatu">Sepatu</option>
                            <option value="Sandal">Sandal</option>
                            <option value="Tas">Tas</option>
                            <option value="Koper">Koper</option>
                            <option value="Lain Lain">Lain Lain</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3 mt-3">
					<label for="gambar" class="col-sm-2 col-form-label">Ilustrasi</label>
					<div class="col-sm-10">
						<input class="form-control mb-2" id="gambar" type="file" accept="image/*" name="gambar">
						<img src="{{ asset('storage/assets/img/layout/'.$item->gambar) }}" id="preview" style="max-width: 400px;" >
					</div>
				</div>
                @push('scripts')
				<script type="text/javascript">
                $('input[id="gambar"]').change(function(e) {
					var reader = new FileReader();
					reader.onload = function(e) {
						document.getElementById('preview').src = e.target.result;
						document.getElementById('preview').hidden = false;
					};
					reader.readAsDataURL(this.files[0]);
				});
            	</script>
				@endpush

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        </div>

    </div>
    </div>
</section>

</main>