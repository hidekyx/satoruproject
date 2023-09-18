<section class="pt-5 pb-5 lazy-bg bg-loaded" data-bg-image="{{ asset('storage/assets/img/layout/autentikasi.jpg') }}" data-bg="{{ asset('storage/assets/img/layout/autentikasi.jpg') }}" data-ll-status="loaded" style="background-image: url({{ asset('storage/assets/img/layout/autentikasi.jpg') }});">
    <div class="container-fluid d-flex flex-column">
        <div class="row align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4 col-xl-3 mx-auto">
                <div class="card">
                    <div class="card-body py-5 px-sm-5">
                        <div class="mb-5 text-center">
                            <h6 class="h3 mb-1">Sign In</h6>
                            <p class="text-muted mb-0">Masuk untuk melanjutkan.</p>
                        </div><span class="clearfix"></span>
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
                                <strong><i class="fa fa-exclamation-circle"></i> Registrasi Berhasil!</strong>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <form role="form" class="form-validate" action="{{ asset('/login_action') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                <input type="email" class="form-control" name="email" placeholder="Masukkan email" required="">
                                <span class="input-group-text"><i class="icon-user"></i></span>
                            </div>
                            </div>
                            <div class="form-group ">
                                <label for="password">Password</label>
                                <div class="input-group show-hide-password">
                                    <input class="form-control" name="password" placeholder="Masukkan password" type="password" required="">
                                    <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                </div>
                            </div>
                            <div class="mt-4"><button type="submit" class="btn btn-info btn-block btn-info">Sign in</button></div>
                        </form>
                        <div class="mt-4 text-center"><small>Belum punya akun?</small> <a href="{{ asset('/register') }}" class="small fw-bold text-info">Daftar sekarang</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>