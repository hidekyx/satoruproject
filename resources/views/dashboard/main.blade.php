<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Dashboard - Satoru Project</title>
<meta content="Dashboard | Satoru Project" name="description">
<meta content="Dashboard | Satoru Project" name="keywords">
<meta content="{{ csrf_token() }}" name="csrf-token">

<!-- Favicons -->
<link rel="icon" type="image/png" href="{{ asset('storage/back-assets/img/logo.jpeg') }}">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('storage/back-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('storage/back-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('storage/back-assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('storage/back-assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('storage/back-assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset('storage/back-assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('storage/back-assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
<link href="{{ asset('storage/back-assets/vendor/izitoast/css/iziToast.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.min.css" rel="stylesheet">
<link href="{{ asset('storage/back-assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
@include('dashboard.header')
@include('dashboard.sidenav')
    @if($page == "Dashboard Transaksi")
        @include('dashboard.transaksi_list')
    @elseif($page == "Dashboard Transaksi - Selesai")
        @include('dashboard.transaksi_selesai')
    @elseif($page == "Dashboard Pelanggan")
        @include('dashboard.pelanggan_list')
    @elseif($page == "Dashboard Pelanggan - Password")
        @include('dashboard.pelanggan_password')
    @elseif($page == "Dashboard Ulasan")
        @include('dashboard.ulasan_list')
    @elseif($page == "Dashboard Kategori")
        @include('dashboard.kategori_list')
    @elseif($page == "Dashboard Kategori - Tambah")
        @include('dashboard.kategori_tambah')
    @elseif($page == "Dashboard Kategori - Edit")
        @include('dashboard.kategori_edit')
    @elseif($page == "Dashboard Laporan")
        @include('dashboard.laporan')
    @endif
@include('dashboard.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<link href="{{ asset('storage/back-assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

<script src="{{ asset('storage/back-assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('storage/back-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('storage/back-assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('storage/back-assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('storage/back-assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('storage/back-assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('storage/back-assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('storage/back-assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('storage/back-assets/vendor/izitoast/js/iziToast.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@stack('scripts')

<!-- Template Main JS File -->
<script src="{{ asset('storage/back-assets/js/main.js') }}"></script>

</body>

</html>