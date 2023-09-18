<main id="main" class="main">

<div class="pagetitle">
    <h1>Data Pelanggan</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Beranda</li>
        <li class="breadcrumb-item">Data Pelanggan</li>
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
            <h5 class="card-title">Data Pelanggan</h5>
            <hr>
            <table class="table table-hover table-striped datatable">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Menu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $key => $u)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td class="text-secondary">{{ $u->email }}</td>
                    <td><b>{{ $u->nama }}</b></td>
                    <td class="text-secondary">
                        @php
                        $maxLength = 30;
                        
                        $alamat = preg_split("/.{0,{$maxLength}}\K(?:\s+|$)/s", $u->alamat, 0, PREG_SPLIT_NO_EMPTY);
                        echo $alamat_split = implode("<br>",$alamat);
                        
                        @endphp
                    </td>
                    <td>
                        <a href="{{ asset('/dashboard/pelanggan/password/'.$u->id_user) }}"><button type="button" class="btn btn-primary btn-sm rounded-pill mb-2"><b><i class="bi bi-shield-lock-fill"></i> </b></button></a><br>
                        @if($u->active == "Y")
                        <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#block-{{ $u->id_user }}"><b><i class="bi bi-lock-fill"></i> </b></button>
                        <div class="modal fade" id="block-{{ $u->id_user }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Blokir Akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda yakin ingin memblokir akun dengan email <b>{{ $u->email }}</b>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                    <form action="{{ asset('/dashboard/pelanggan/block/'.$u->id_user) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger text-white"><i class="bi bi-lock-fill"></i> Blokir</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        @elseif($u->active == "N")
                        <button type="button" class="btn btn-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#unblock-{{ $u->id_user }}"><b><i class="bi bi-unlock-fill"></i> </b></button>
                        <div class="modal fade" id="unblock-{{ $u->id_user }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Buka Akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda yakin ingin membuka blokir akun dengan email <b>{{ $u->email }}</b>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                    <form action="{{ asset('/dashboard/pelanggan/unblock/'.$u->id_user) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success text-white"><i class="bi bi-unlock-fill"></i> Buka Blokir</button>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        @endif
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