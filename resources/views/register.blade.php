<section class="pt-5 pb-5 lazy-bg bg-loaded" data-bg-image="{{ asset('storage/assets/img/layout/autentikasi.jpg') }}" data-bg="{{ asset('storage/assets/img/layout/autentikasi.jpg') }}" data-ll-status="loaded" style="background-image: url({{ asset('storage/assets/img/layout/autentikasi.jpg') }});">
    <div class="container-fluid d-flex flex-column">
        <div class="row align-items-center min-vh-100">
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body py-5 px-sm-5">
                        <h3>Daftar Akun</h3>
                        <p>Agar dapat melihat status tracking laundry, anda harus memiliki akun terlebih dahulu.</p>
                        <form id="register" action="{{ asset('/register_action') }}" method="post" enctype="multipart/form-data" class="form-validate mt-5">
                            @csrf
                            <div class="h5 mb-4">Informasi Akun</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Isi nama lengkap" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Isi alamat email" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <div class="input-group show-hide-password">
                                        <input class="form-control" name="password" placeholder="Isi password" type="password" required="">
                                        <span class="input-group-text"><i class="icon-eye" aria-hidden="true" style="cursor: pointer;"></i></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="konfirmasi_password">Konfirmasi Password</label>
                                    <div class="input-group show-hide-password">
                                        <input class="form-control" name="konfirmasi_password" placeholder="Konfirmasi password" type="password" required="">
                                        <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="telepon">No Telp</label>
                                    <input class="form-control" type="text" name="no_telp" placeholder="Isi nomor telepon" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" placeholder="Tuliskan alamat lengkap anda" required="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info m-t-30 mt-3">Daftar</button>
                        </form>
                        <div class="mt-4"><small>Sudah memiliki akun?</small> <a href="{{ asset('/login') }}" class="small fw-bold text-info">Login di sini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>