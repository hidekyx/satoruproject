<main id="main" class="main">

<div class="pagetitle">
    <h1>Laporan Transaksi</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Beranda</li>
        <li class="breadcrumb-item">Laporan</li>
        <li class="breadcrumb-item active">Laporan Transaksi</li>
    </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">

    <div class="col-lg-6">
        <div class="row">
            <div class="col-md-6">
                <div class="card info-card sales-card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start"><h6>Filter</h6></li>
                        <li><a class="dropdown-item filters" data-kategori="laundry" data-filter="mingguan" id="laporan-laundry-mingguan" href="#">7 hari terakhir</a></li>
                        <li><a class="dropdown-item filters" data-kategori="laundry" data-filter="bulanan" id="laporan-laundry-bulanan" href="#">Bulan ini</a></li>
                        <li><a class="dropdown-item filters" data-kategori="laundry" data-filter="tahunan" id="laporan-laundry-tahunan" href="#">Tahun ini</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Laundry <span id="laporan-laundry-filter">| 7 hari terakhir</span></h5>
                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                        <h6 id="laporan-laundry">{{ $laporan['laundry']['mingguan'] }}</h6>
                        <span class="text-primary small pt-1 fw-bold">Laundry</span><span class="text-muted small pt-2 ps-1">selesai</span>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card info-card customers-card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start"><h6>Filter</h6></li>
                        <li><a class="dropdown-item filters" data-kategori="pelanggan" data-filter="mingguan" id="laporan-pelanggan-mingguan" href="#">7 hari terakhir</a></li>
                        <li><a class="dropdown-item filters" data-kategori="pelanggan" data-filter="bulanan" id="laporan-pelanggan-bulanan" href="#">Bulan ini</a></li>
                        <li><a class="dropdown-item filters" data-kategori="pelanggan" data-filter="tahunan" id="laporan-pelanggan-tahunan" href="#">Tahun ini</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pelanggan <span id="laporan-pelanggan-filter">| 7 hari terakhir</span></h5>
                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6 id="laporan-pelanggan">{{ $laporan['pelanggan']['mingguan'] }}</h6>
                        <span class="text-muted small pt-1">Total </span><span class="text-warning small pt-1 fw-bold">pelanggan</span>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card info-card revenue-card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start"><h6>Filter</h6></li>
                        <li><a class="dropdown-item filters" data-kategori="pendapatan" data-filter="mingguan" id="laporan-pendapatan-mingguan" href="#">7 hari terakhir</a></li>
                        <li><a class="dropdown-item filters" data-kategori="pendapatan" data-filter="bulanan" id="laporan-pendapatan-bulanan" href="#">Bulan ini</a></li>
                        <li><a class="dropdown-item filters" data-kategori="pendapatan" data-filter="tahunan" id="laporan-pendapatan-tahunan" href="#">Tahun ini</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pendapatan <span id="laporan-pendapatan-filter">| 7 hari terakhir</span></h5>
                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cash"></i>
                    </div>
                    <div class="ps-3">
                        <h6 id="laporan-pendapatan">{{ $laporan['pendapatan']['mingguan'] }}</h6>
                        <span class="text-muted small pt-1">Total </span><span class="text-success small pt-1 fw-bold">pendapatan</span>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            @push('scripts')
            <script>
                $('.filters').click(function(){
                    var kategori = $(this).data('kategori');
                    var filter = $(this).data('filter');
                    if(filter == "mingguan") {
                        teks_filter = "| 7 hari terakhir";
                    }
                    else if(filter == "bulanan") {
                        teks_filter = "| Bulan ini";
                    }
                    else if(filter == "bulanan") {
                        teks_filter = "| Tahun ini";
                    }
                    var data = @json($laporan);
                    $('#laporan-'+ kategori).html(data[kategori][filter]);
                    $('#laporan-'+ kategori +'-filter').html(teks_filter);
                });
            </script>
            @endpush

        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Laporan Laundry <span>/Keuangan</span></h5>
                <div id="areaChart"></div>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var data_tahunan = @json($laporan['grafik']['tahunan']);
                        var data_bulanan = @json($laporan['grafik']['bulanan']);
                        
                        const series = {
                        "tahunan": {
                            "data": data_tahunan['data'],
                            "dates": data_tahunan['tanggal'],
                        },
                        }
                        new ApexCharts(document.querySelector("#areaChart"), {
                        series: [{
                            name: "Pendapatan",
                            data: series.tahunan.data
                        }],
                        chart: {
                            type: 'area',
                            height: 350,
                            zoom: {
                            enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        subtitle: {
                            text: 'Pendapatan Hasil Laundry',
                            align: 'left'
                        },
                        labels: series.tahunan.dates,
                        xaxis: {
                            type: 'datetime',
                        },
                        yaxis: {
                            opposite: true
                        },
                        legend: {
                            horizontalAlign: 'left'
                        }
                        }).render();
                    });
                </script>
            </div>
            </div>
        </div>
    </div>
    </div>

    <div class="col-lg-6">
        <div class="card top-selling overflow-auto">
            <div class="card-body pb-0">
                <h5 class="card-title">Kategori Laundry  <span>| Terbanyak</span></h5>
                <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Tercuci</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporan['barang'] as $lb)
                    <tr>
                        <th scope="row"><a href="#"><img src="{{ asset('storage/assets/img/layout/'.$lb->item->gambar) }}" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">{{ $lb->item->nama_item }}</a></td>
                        <td>@duit($lb->item->harga)</td>
                        <td class="fw-bold">{{ $lb->penjualan }}</td>
                        <td>@duit($lb->item->harga*$lb->penjualan)</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>

        <div class="card">
        <div class="card-body pb-0">
            <h5 class="card-title">Grafik Data Laundry <span>| Terbanyak</span></h5>
            <div id="pieChart"></div>
            <script>
            document.addEventListener("DOMContentLoaded", () => {
                var data = @json($laporan['barang']);
                new ApexCharts(document.querySelector("#pieChart"), {
                series: [data[0]['penjualan'], data[1]['penjualan'], data[2]['penjualan'], data[3]['penjualan'], data[4]['penjualan']],
                chart: {
                    height: 350,
                    type: 'pie',
                    toolbar: {
                    show: true
                    }
                },
                labels: [data[0]['item']['nama_item'], data[1]['item']['nama_item'], data[2]['item']['nama_item'], data[3]['item']['nama_item'], data[4]['item']['nama_item']]
                }).render();
            });
            </script>
        </div>
        </div>

    </div>

    </div>
</section>

</main>