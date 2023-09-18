<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;

class TrackingController extends Controller
{
    public function tracking_list() {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $transaksi = Transaksi::where('id_user', $id_user)->where('status', '!=', 'Laundry Selesai')->orderBy('created_at', 'DESC')->get();
            return view("main", [
                'page' => "Tracking List",
                'subtitle' => "Tracking Laundry",
                'logged_user' => $logged_user,
                'transaksi' => $transaksi,
            ]);
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function transaksi_list() {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $transaksi = Transaksi::where('id_user', $id_user)->where('status', 'Laundry Selesai')->orderBy('created_at', 'DESC')->get();
            return view("main", [
                'page' => "Transaksi List",
                'subtitle' => "Riwayat Transaksi Laundry",
                'logged_user' => $logged_user,
                'transaksi' => $transaksi,
            ]);
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function invoice($id_transaksi) {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $transaksi = Transaksi::where('id_user', $id_user)->where('id_transaksi', $id_transaksi)->first();
            if($transaksi != null) {
                if($transaksi->status == "Selesai Dicuci" || $transaksi->status == "Laundry Selesai") {
                    $no_invoice = "INV/".str_replace('-', '', $transaksi->tanggal_invoice)."/".$transaksi->id_user."/".$id_transaksi;
                    $pdf = PDF::loadview('shop.invoice', ['transaksi'=>$transaksi, 'no_invoice'=>$no_invoice, 'logged_user'=>$logged_user]);
                    return $pdf->stream('Invoice - '.$logged_user->nama.' - '. $transaksi->created_at .'.pdf');
                }
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}