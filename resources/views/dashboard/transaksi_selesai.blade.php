<main id="main" class="main">

<div class="pagetitle">
    <h1>Data Transaksi</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Beranda</li>
        <li class="breadcrumb-item">Data Transaksi</li>
        <li class="breadcrumb-item active">Selesai Cuci</li>
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
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Selesaikan Cuci Laundry</h5>
            <form action="{{ asset('/dashboard/transaksi/selesai_action/'.$transaksi->id_transaksi) }}" method="post" enctype="multipart/form-data">
			@csrf
				@foreach($transaksi->detail as $key => $td)
				<div class="row">
					<p style="color: #012970; font-weight: 500; font-size: 18px;">Barang #{{ $key+1 }}</p>
					<div class="col-sm-2">Detail Item</div>
					<div class="col-sm-10">{{ $td->item->nama_item }}</div>
					<div class="col-sm-2"></div>
					<div class="col-sm-10"><b>Merk:</b> {{ $td->merk }}</div>
					<div class="col-sm-2"></div>
					<div class="col-sm-10"><b>Seri:</b> {{ $td->seri }}</div>
				</div>
				<div class="row mb-3 mt-3">
					<label for="inputNumber" class="col-sm-2 col-form-label">Hasil Cuci</label>
					<div class="col-sm-10">
						<input class="form-control mb-2" id="foto_hasil_{{ $key+1 }}" type="file" accept="image/*" name="foto_hasil[]" required>
						<img src="https://placehold.it/80x80" hidden="true" id="preview_hasil_{{ $key+1 }}" style="max-width: 400px;" >
					</div>
				</div>
				<hr>
				@push('scripts')
				<script type="text/javascript">
                $('input[id="foto_hasil_{{ $key+1 }}"]').change(function(e) {
					var reader = new FileReader();
					reader.onload = function(e) {
						document.getElementById('preview_hasil_{{ $key+1 }}').src = e.target.result;
						document.getElementById('preview_hasil_{{ $key+1 }}').hidden = false;
					};
					reader.readAsDataURL(this.files[0]);
				});
            	</script>
				@endpush
				@endforeach
				
				<div class="row mb-3">
					<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary"><b><i class="bi bi-check2-circle"></i> Selesai</b></button></a></td>
					</div>
				</div>
			</form>
        </div>
        </div>

    </div>
    </div>
</section>

</main>