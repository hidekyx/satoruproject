<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function cart_add(Request $request, $id_item) {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $rules = [
                'merk' => 'required|string',
                'seri' => 'required|string',
            ];
            $messages = [
                'merk.required' => 'Merk / brand wajib diisi',
                'merk.string' => 'Merk /brand tidak valid',
                'seri.required' => 'Tipe / series wajib diisi',
                'seri.string' => 'Tipe / series tidak valid',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }

            $keranjang = new Keranjang([
                'id_user' => $id_user,
                'id_item' => $id_item,
                'merk' => $request->get('merk'),
                'seri' => $request->get('seri'),
            ]);
            $keranjang->save();

            return redirect('/keranjang/berhasil');
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function cart_success() {
        return view("main", [
            'page' => "Keranjang Berhasil",
        ]);
    }

    public function cart_list() {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $keranjang = Keranjang::where('id_user', $id_user)->where('status', 'Dikeranjang')->get();
            if(count($keranjang)) {
                $total_harga = null;
                foreach($keranjang as $k) {
                    $total_harga = $total_harga + $k->item->harga;
                }
                return view("main", [
                    'page' => "Keranjang Laundry",
                    'subtitle' => "Daftar barang di keranjang",
                    'logged_user' => $logged_user,
                    'keranjang' => $keranjang,
                    'total_harga' => $total_harga
                ]);
            }
            else {
                return view("main", [
                    'page' => "Keranjang Kosong",
                    'subtitle' => "Daftar barang di Keranjang",
                    'logged_user' => $logged_user,
                ]);
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function cart_delete($id_keranjang) {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $keranjang = Keranjang::where('id_keranjang', $id_keranjang)->where('id_user', $id_user)->first();
            if($keranjang) {
                $keranjang->delete();
                return redirect('/keranjang/list')->with('success', 'Pesanan di keranjang telah dihapus');
            }
            else {
                return redirect('/keranjang/list')->with('error', 'Pesanan tidak terhapus');
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function checkout(Request $request) {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $keranjang = Keranjang::where('id_user', $id_user)->where('status', 'Dikeranjang')->get();
            if($keranjang) {
                $total = null;
                foreach($keranjang as $k) {
                    $total = $total + $k->item->harga;
                }
                if($request->get('pengiriman') == "Jemput & Antar") {
                    $status = "Proses Penjemputan";
                }
                elseif($request->get('pengiriman') == "Datang ke Toko") {
                    $status = "Barang Diterima";
                }
                $transaksi = new Transaksi([
                    'id_user' => $id_user,
                    'pengiriman' => $request->get('pengiriman'),
                    'alamat' => $request->get('alamat'),
                    'pembayaran' => $request->get('pembayaran'),
                    'total' => $total,
                    'status' => $status
                ]);
                if($transaksi->save()) {
                    $id_transaksi = $transaksi->id_transaksi;
                    foreach($keranjang as $k) {
                        $detail_transaksi = new DetailTransaksi([
                            'id_transaksi' => $id_transaksi,
                            'id_item' => $k->id_item,
                            'merk' => $k->merk,
                            'seri' => $k->seri
                        ]);
                        $detail_transaksi->save();
                        $k->status = "Checkout";
                        $k->update();
                    }
                    return redirect('/tracking/list')->with('success', 'Pesanan telah di-checkout');
                }
            }
            else {
                return redirect('/keranjang/list')->with('error', 'Pesanan gagal checkout');
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}