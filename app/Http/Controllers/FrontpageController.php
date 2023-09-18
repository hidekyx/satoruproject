<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class FrontpageController extends Controller
{
    public function home() {
        $logged_user = Auth::user();
        $item = Item::get();
        $kategori = Item::select('kategori')->distinct()->get();
        $review = Transaksi::where('status', "Laundry Selesai")->where('ulasan', '!=', null)->orderBy('id_transaksi', 'DESC')->limit(5)->get();
        // dd($review[0]->detail);
        return view("main", [
            'page' => "Home",
            'logged_user' => $logged_user,
            'kategori' => $kategori,
            'item' => $item,
            'review' => $review,
        ]);
    }

    public function detail_item($id_item) {
        $item = Item::where('id_item', $id_item)->first();
        if($item) {
            return view("main", [
                'page' => "Detail",
                'item' => $item
            ]);
        }
    }
}