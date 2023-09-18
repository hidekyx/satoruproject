<main id="main" class="main">

<div class="pagetitle">
    <h1>Data Pelanggan</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Beranda</li>
        <li class="breadcrumb-item">Data Pelanggan</li>
        <li class="breadcrumb-item active">Ubah Password</li>
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
            <h5 class="card-title mb-0 pb-0">Ubah Password</h5>
            <p class="text-secondary mt-0">{{ $user->email }}</p>
            <form action="{{ asset('/dashboard/pelanggan/password_action/'.$user->id_user) }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                    <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="password" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-md-8 col-lg-9">
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" required>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
        </div>
        </div>

    </div>
    </div>
</section>

</main>