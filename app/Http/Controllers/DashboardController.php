<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Item;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard_transaksi() {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $transaksi = Transaksi::orderBy('created_at', 'DESC')->get();
                return view("dashboard.main", [
                    'page' => "Dashboard Transaksi",
                    'logged_user' => $logged_user,
                    'transaksi' => $transaksi,
                ]);
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_transaksi_jemput($id_transaksi) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $transaksi = Transaksi::find($id_transaksi);
                if (!$transaksi) {
                    echo "error"; die();
                }
                $transaksi->status = "Barang Diterima";
                if($transaksi->update())
                {
                    Session::flash('success', 'Barang laundry telah berhasil dijemput');
                    return redirect('/dashboard/transaksi');
                }
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_transaksi_cuci($id_transaksi) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $transaksi = Transaksi::find($id_transaksi);
                if (!$transaksi) {
                    echo "error"; die();
                }
                $transaksi->status = "Sedang Dicuci";
                if($transaksi->update())
                {
                    Session::flash('success', 'Barang laundry akan diproses');
                    return redirect('/dashboard/transaksi');
                }
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_transaksi_selesai_view($id_transaksi) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
                if($transaksi->status == "Sedang Dicuci") {
                    return view("dashboard.main", [
                        'page' => "Dashboard Transaksi - Selesai",
                        'logged_user' => $logged_user,
                        'transaksi' => $transaksi,
                    ]);
                }
                else {
                    Session::flash('error', 'Barang laundry sudah dalam proses menunggu pembayaran');
                    return redirect('/dashboard/transaksi');    
                }
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_transaksi_selesai_action(Request $request, $id_transaksi) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $transaksi = Transaksi::find($id_transaksi);
                if (!$transaksi) {
                    echo "error"; die();
                }
                $transaksi->status = "Selesai Dicuci";
                $transaksi->tanggal_invoice = date("Y-m-d");
                foreach($transaksi->detail as $key => $td) {
                    $filenameWithExt = $request->file("foto_hasil")[$key]->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file("foto_hasil")[$key]->getClientOriginalExtension();
                    $filenameSimpan = md5($filename. time()).'.'.$extension;
                    $foto_hasil[$key] = $filenameSimpan;
                    $path = $request->file("foto_hasil")[$key]->storeAs('public/hasil_cuci', $filenameSimpan);
                    $td->foto_hasil = $foto_hasil[$key];
                    $td->update();
                }
                if($transaksi->update())
                {
                    Session::flash('success', 'Barang laundry telah selesai dicuci, menunggu proses pengemasan');
                    return redirect('/dashboard/transaksi');
                }
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_transaksi_kemas($id_transaksi) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $transaksi = Transaksi::find($id_transaksi);
                if (!$transaksi) {
                    echo "error"; die();
                }
                if($transaksi->pengiriman == "Jemput & Antar") {
                    $transaksi->status = "Barang Sedang Diantar";
                }
                elseif($transaksi->pengiriman == "Datang ke Toko") {
                    $transaksi->status = "Barang Siap Diambil";
                }
                if($transaksi->update())
                {
                    Session::flash('success', 'Barang laundry berhasil dikemas');
                    return redirect('/dashboard/transaksi');
                }
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_transaksi_bayar($id_transaksi) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $transaksi = Transaksi::find($id_transaksi);
                if (!$transaksi) {
                    echo "error"; die();
                }
                $transaksi->status = "Laundry Selesai";
                $transaksi->tanggal_pembayaran = date("Y-m-d H:i:s");
                if($transaksi->update())
                // Insert here kalau mau ada notifikasi whatsapp atau email
                {
                    Session::flash('success', 'Barang laundry telah berhasil diselesaikan');
                    return redirect('/dashboard/transaksi');
                }
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_pelanggan() {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $user = User::orderBy('id_user', 'ASC')->get();
                return view("dashboard.main", [
                    'page' => "Dashboard Pelanggan",
                    'logged_user' => $logged_user,
                    'user' => $user,
                ]);
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_pelanggan_password_view($id_user) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $user = User::where('id_user', $id_user)->first();
                return view("dashboard.main", [
                    'page' => "Dashboard Pelanggan - Password",
                    'logged_user' => $logged_user,
                    'user' => $user,
                ]);
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_pelanggan_password_action(Request $request, $id_user) {
        $rules = [
            'password'                       => 'required|string|confirmed'
        ];
        $messages = [
            'password.required'              => 'Password baru wajib diisi',
            'password_confirmation.required' => 'Password baru wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = User::find($id_user);
        if (!$user) {
            echo "gaada"; die();
        }

        $user->password = bcrypt($request->get('password'));

        if($user->update()) {
            return redirect()->back()->with('success', 'Password berhasil dirubah');   
        }
    }

    public function dashboard_pelanggan_block(Request $request, $id_user) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $user = User::find($id_user);
                if (!$user) {
                    echo "gaada"; die();
                }

                $user->active = "N";
                if($user->update()) {
                    return redirect('/dashboard/pelanggan')->with('success', 'User telah diblokir');
                }
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function dashboard_pelanggan_unblock(Request $request, $id_user) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $user = User::find($id_user);
                if (!$user) {
                    echo "gaada"; die();
                }

                $user->active = "Y";
                if($user->update()) {
                    return redirect('/dashboard/pelanggan')->with('success', 'User telah aktif kembali');
                }
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function dashboard_ulasan() {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $review = Transaksi::where('status', "Laundry Selesai")->where('ulasan', '!=', null)->orderBy('id_transaksi', 'DESC')->get();
                return view("dashboard.main", [
                    'page' => "Dashboard Ulasan",
                    'logged_user' => $logged_user,
                    'review' => $review,
                ]);
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_kategori() {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $item = Item::orderBy('id_item', 'ASC')->get();
                return view("dashboard.main", [
                    'page' => "Dashboard Kategori",
                    'logged_user' => $logged_user,
                    'item' => $item,
                ]);
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_kategori_tambah() {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                return view("dashboard.main", [
                    'page' => "Dashboard Kategori - Tambah",
                    'logged_user' => $logged_user
                ]);
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_kategori_tambah_action(Request $request) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $id_user = $logged_user->id_user;
                $rules = [
                    'nama_item' => 'required|string',
                    'harga' => 'required|int',
                    'kategori' => 'required|string',
                ];
                $messages = [
                    'nama_item.required' => 'Nama item wajib diisi',
                    'nama_item.string' => 'Nama item tidak valid',
                    'harga.required' => 'Harga wajib diisi',
                    'harga.int' => 'Harga tidak valid',
                    'kategori.required' => 'Kategori wajib diisi',
                    'kategori.string' => 'Kategori tidak valid',
                ];

                $validator = Validator::make($request->all(), $rules, $messages);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput($request->all);
                }

                $filenameWithExt = $request->file("gambar")->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file("gambar")->getClientOriginalExtension();
                $filenameSimpan = md5($filename. time()).'.'.$extension;
                $gambar = $filenameSimpan;
                $path = $request->file("gambar")->storeAs('public/assets/img/layout', $filenameSimpan);

                $item = new Item([
                    'nama_item' => $request->get('nama_item'),
                    'harga' => $request->get('harga'),
                    'kategori' => $request->get('kategori'),
                    'gambar' => $gambar,
                ]);
                $item->save();

                return redirect('/dashboard/kategori')->with('success', 'Data kategori barang telah ditambahkan');
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function dashboard_kategori_edit($id_item) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $item = Item::where('id_item', $id_item)->first();
                return view("dashboard.main", [
                    'page' => "Dashboard Kategori - Edit",
                    'logged_user' => $logged_user,
                    'item' => $item
                ]);
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function dashboard_kategori_edit_action(Request $request, $id_item) {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $id_user = $logged_user->id_user;
                $rules = [
                    'nama_item' => 'required|string',
                    'harga' => 'required|int',
                    'kategori' => 'required|string',
                ];
                $messages = [
                    'nama_item.required' => 'Nama item wajib diisi',
                    'nama_item.string' => 'Nama item tidak valid',
                    'harga.required' => 'Harga wajib diisi',
                    'harga.int' => 'Harga tidak valid',
                    'kategori.required' => 'Kategori wajib diisi',
                    'kategori.string' => 'Kategori tidak valid',
                ];

                $validator = Validator::make($request->all(), $rules, $messages);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput($request->all);
                }

                $item = Item::find($id_item);
                if (!$item) {
                    echo "gaada"; die();
                }

                $gambar = null;
                if ($request->hasFile('gambar')) {
                    $filenameWithExt = $request->file("gambar")->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file("gambar")->getClientOriginalExtension();
                    $filenameSimpan = md5($filename. time()).'.'.$extension;
                    $gambar = $filenameSimpan;
                    $path = $request->file("gambar")->storeAs('public/assets/img/layout', $filenameSimpan);
                    $item->gambar = $gambar;
                }

                $item->nama_item = $request->get('nama_item');
                $item->harga = $request->get('harga');
                $item->kategori = $request->get('kategori');
                $item->update();

                return redirect('/dashboard/kategori')->with('success', 'Data kategori barang telah diperbaharui');
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function dashboard_laporan() {
        if (Auth::check()) {
            if(Auth::user()->role == "Admin") {
                $logged_user = Auth::user();
                $now = date('Y-m-d H:i:s');
                $week = date('Y-m-d H:i:s', strtotime('-7 days'));
                $laporan['laundry']['tahunan'] = Transaksi::where('status', "Laundry Selesai")->whereyear('tanggal_pembayaran', date('Y'))->count();
                $laporan['laundry']['bulanan'] = Transaksi::where('status', "Laundry Selesai")->whereMonth('tanggal_pembayaran', date('m'))->whereyear('tanggal_pembayaran', date('Y'))->count();
                $laporan['laundry']['mingguan'] = Transaksi::where('status', "Laundry Selesai")->whereBetween('tanggal_pembayaran', [$week, $now])->count();
                $laporan['pendapatan']['tahunan'] = 'Rp'.number_format(Transaksi::where('status', "Laundry Selesai")->whereyear('tanggal_pembayaran', date('Y'))->get()->sum('total'));
                $laporan['pendapatan']['bulanan'] = 'Rp'.number_format(Transaksi::where('status', "Laundry Selesai")->whereMonth('tanggal_pembayaran', date('m'))->whereyear('tanggal_pembayaran', date('Y'))->get()->sum('total'));
                $laporan['pendapatan']['mingguan'] = 'Rp'.number_format(Transaksi::where('status', "Laundry Selesai")->whereBetween('tanggal_pembayaran', [$week, $now])->get()->sum('total'));
                $laporan['pelanggan']['tahunan'] = User::whereyear('created_at', date('Y'))->count();
                $laporan['pelanggan']['bulanan'] = User::whereMonth('created_at', date('m'))->whereyear('created_at', date('Y'))->count();
                $laporan['pelanggan']['mingguan'] = User::whereBetween('created_at', [$week, $now])->count();
                $laporan['barang'] = DetailTransaksi::selectRaw('count(*) as penjualan, id_item')->groupBy('id_item')->orderByRaw('COUNT(*) DESC')->limit(5)->get();
                $laporan['keuangan']['tahunan'] = Transaksi::where('status', "Laundry Selesai")->whereyear('tanggal_pembayaran', date('Y'))->get();
                $laporan['keuangan']['bulanan'] = Transaksi::where('status', "Laundry Selesai")->whereMonth('tanggal_pembayaran', date('m'))->whereyear('tanggal_pembayaran', date('Y'))->get();
                $laporan['keuangan']['mingguan'] = Transaksi::where('status', "Laundry Selesai")->whereBetween('tanggal_pembayaran', [$week, $now])->get();
                foreach($laporan['keuangan']['tahunan'] as $key => $lk) {
                    $laporan['grafik']['tahunan']['data'][$key] = $lk->total;
                    $laporan['grafik']['tahunan']['tanggal'][$key] = $lk->tanggal_pembayaran;
                }
                foreach($laporan['keuangan']['bulanan'] as $key => $lk) {
                    $laporan['grafik']['bulanan']['data'][$key] = $lk->total;
                    $laporan['grafik']['bulanan']['tanggal'][$key] = $lk->tanggal_pembayaran;
                }
                foreach($laporan['keuangan']['mingguan'] as $key => $lk) {
                    $laporan['grafik']['mingguan']['data'][$key] = $lk->total;
                    $laporan['grafik']['mingguan']['tanggal'][$key] = $lk->tanggal_pembayaran;
                }
                // dd($laporan['grafik']);
                
                return view("dashboard.main", [
                    'page' => "Dashboard Laporan",
                    'logged_user' => $logged_user,
                    'laporan' => $laporan,
                ]);
            }
            else {
                Session::flash('error', 'Anda tidak diizinkan untuk mengakses halaman ini');
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }
}