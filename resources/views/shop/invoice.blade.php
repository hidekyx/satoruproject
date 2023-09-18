<!DOCTYPE html>
<html>
<head>
	<title>Invoice - {{ $logged_user->nama }} - {{ \Carbon\Carbon::parse($transaksi->created_at)->isoFormat('D MMMM Y')}}</title>
    <!-- <link rel="stylesheet" href="https://barat.jakarta.go.id/kominfotik/storage/assets/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>
<body>
	<style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }
        p {
            font-size: 11px;
        }
        .margin_0 {
            margin-bottom: 3px;
            margin-top: 0px;
            padding-bottom: 0px;
            padding-top: 0px;
        }
        .no_border {
            border: 0px solid black;
            border-collapse: collapse;
        }
        .borderer {
            border: 1px solid black;
            border-left: 0;
            border-right: 0;
        }
        .paddinger {
            padding-top: 10px;
            padding-bottom: 10px;
        }
	</style>
    <img style="position: absolute; left: 0px;" src="{{ asset('storage/assets/img/layout/about.jpeg') }}" width="130px">
	<div align="right">
		<h5 style="font-size: 40px;" class="margin_0">INVOICE</h5>
	</div>
    <hr style="background: black; margin-bottom: 100px;" class="mt-1">
    <table border="0" style="width: 100%; margin-bottom: 40px;" class="no_border">
        <tr>
            <td align="left">
                <h5 style="font-size: 12px;" class="margin_0 font-weight-bolder">BILLED TO:</h5>
                <p class="margin_0">{{ $transaksi->user->nama }}</p>
                <p class="margin_0">{{ $transaksi->user->no_telp }}</p>
                <p class="margin_0">{{ $transaksi->user->alamat }}</p>
            </td>
            <td align="right">
                <h5 style="font-size: 12px;" class="margin_0 font-weight-bolder">INVOICE NUMBER AND DATE:</h5>
                <p class="margin_0">{{ $no_invoice }}</p>
                <p class="margin_0">{{ \Carbon\Carbon::parse($transaksi->tanggal_invoice)->isoFormat('D MMMM Y')}}</p>
            </td>
        </tr>
    </table>
    @if($transaksi->status == "Laundry Selesai")
    <img style="position: absolute; left: 50;" src="{{ asset('storage/assets/img/layout/paid.png') }}" width="530px">
    @endif
    <table style="width: 100%; margin-bottom: 60px;" class="borderer">
        <thead>
            <th class="paddinger" align="left">Item</th>
            <th>Quantity</th>
            <th>Price per Unit</th>
            <th>Total</th>
        </thead>
        <tbody align="center" class="borderer">
            @foreach($transaksi->detail as $td)
            <tr>
                <td class="paddinger" align="left">
                    <b style="font-size: 12px;">{{ $td->item->nama_item }}</b><br>
                    <b>Merk</b>: {{ $td->merk }}<br>
                    <b>Seri</b>: {{ $td->seri }}
                </td>
                <td>1</td>
                <td>@duit($td->item->harga)</td>
                <td>@duit($td->item->harga)</td>
            </tr>
            @endforeach
        </tbody>
        <thead>
            <th></th>
            <th></th>
            <th class="paddinger">Total</th>
            <th><b>@duit($transaksi->total)</b></th>
        </thead>
    </table>
    <table border="0" style="width: 100%; margin-bottom: 40px;" class="no_border">
        <tr>
            <td align="left">
                <h5 style="font-size: 12px;" class="margin_0 font-weight-bolder">Payment Info:</h5>
                <p class="margin_0">BCA: 327601322</p>
                <p class="margin_0">Gopay / OVO / Dana: 087883122665</p>
                <p class="margin_0">a/n Satoru Project</p>
            </td>
            <td align="right">
                <h5 style="font-size: 12px;" class="margin_0 font-weight-bolder">Authorized Sign:</h5>
                <img src="{{ asset('storage/assets/img/layout/sign.png') }}" width="130px">
            </td>
        </tr>
    </table>
    <table border="0" style="width: 100%; margin-bottom: 40px;" class="no_border">
        <tr>
            <td align="left">
                <h5 style="font-size: 12px;" class="margin_0 font-weight-bolder">Terms and Condition:</h5>
                <p class="margin_0">Payment needs to be processed within 2 days after laundry is complete.</p>
            </td>
        </tr>
    </table>
</body>
</html>