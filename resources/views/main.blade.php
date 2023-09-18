<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Satoru" />
    <meta name="description" content="Satoru - Shoe and Bag Laundry">
    <link rel="icon" type="image/png" href="{{ asset('storage/assets/img/layout/about.jpeg') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SATORU | Shoe and Bag Laundry</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/css/custom.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/plugins/glightbox/glightbox.min.css') }}" />
</head>

<body>
    <div class="body-inner">
        @if($page == "Login")
            @include('login')
        @elseif($page == "Register")
            @include('register')
        @elseif($page == "Home")
            @include('header')
            @include('home.slider')
            @include('home.about')
            @include('home.pricelist')
            @include('home.review')
            @include('home.cta')
            @include('footer')
        @elseif($page == "Detail")
            @include('shop.detail')
        @elseif($page == "Keranjang Berhasil")
            @include('shop.keranjang_berhasil')
        @elseif($page == "Keranjang Laundry")
            @include('header')
            @include('breadcrump')
            @include('shop.keranjang_list')
            @include('footer')
        @elseif($page == "Keranjang Kosong")
            @include('header')
            @include('breadcrump')
            @include('shop.keranjang_kosong')
            @include('footer')
        @elseif($page == "Tracking List")
            @include('header')
            @include('breadcrump')
            @include('shop.tracking_list')
            @include('footer')
        @elseif($page == "Transaksi List")
            @include('header')
            @include('breadcrump')
            @include('shop.transaksi_list')
            @include('footer')
        @elseif($page == "Ulas Laundry")
            @include('header')
            @include('breadcrump')
            @include('shop.ulasan')
            @include('footer')
        @endif
    </div>
    
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <script src="{{ asset('storage/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('storage/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('storage/assets/js/functions.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/glightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/particles/particles.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/particles/particles-stars.js') }}"></script>
    <script src="{{ asset('storage/assets/js/custom.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/validate/validate.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/validate/validate-rules.js') }}"></script>
</body>

</html>