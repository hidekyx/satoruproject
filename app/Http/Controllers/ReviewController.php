<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review_view($id_transaksi) {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $transaksi = Transaksi::where('id_user', $id_user)->where('id_transaksi', $id_transaksi)->where('status', 'Laundry Selesai')->first();
            $no_invoice = "INV/".str_replace('-', '', $transaksi->tanggal_invoice)."/".$transaksi->id_user."/".$id_transaksi;
            if($transaksi) {
                return view("main", [
                    'page' => "Ulas Laundry",
                    'subtitle' => "Tracking Laundry",
                    'logged_user' => $logged_user,
                    'transaksi' => $transaksi,
                    'no_invoice' => $no_invoice,
                ]);
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function review_store(Request $request, $id_transaksi) {
        if (Auth::check()) {
            $logged_user = Auth::user();
            $id_user = $logged_user->id_user;
            $transaksi = Transaksi::where('id_user', $id_user)->where('id_transaksi', $id_transaksi)->where('status', 'Laundry Selesai')->first();
            if($transaksi) {
                $transaksi->ulasan = $request->get('ulasan');
                $transaksi->rate = $request->get('rate');
                if($transaksi->update()) {
                    return redirect('/ulasan/'.$id_transaksi)->with('success', 'Ulasan anda telah disimpan');
                }
            }
        }
        else {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }
    }
}