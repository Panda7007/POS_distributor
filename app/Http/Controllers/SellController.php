<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use App\Models\Account;
use App\Models\Product;
use App\Models\Reseller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellController extends Controller
{
    public function index()
    {
        return view("sells.index", [
            "title" => "Sells",
            "debits" => Sell::get(),
            "saldo" => Account::latest()->limit(1)->get()
        ]);
    }

    public function create()
    {
        return view("sells.create", [
            "title" => "Transactions",
            "products" => Product::get(),
            "resellers" => Reseller::get(),
            "saldo" => Account::latest()->limit(1)->get()
        ]);
    }

    public function store(Request $request)
    {
        $sync = [];
        $laba = 0;
        foreach ($request->transaksi["products"] as $product) {
            $sync[$product["id"]] = ["jumlah" => $product["jumlah"], "harga" => $product["harga"]];
            $produk = Product::find($product["id"]);
            $laba += ((intval($product["harga"]) / intval($product["jumlah"])) - intval($produk->biaya_produksi)) * intval($product["jumlah"]);
            $produk->update([
                "stok" => intval($produk->stok) - intval($product["jumlah"]),
                "terjual" => intval($produk->terjual) + intval($product["jumlah"])
            ]);
            foreach ($produk->materials as $material) {
                $material->update([
                    "stok" => intval($material->stok) - (intval($product["jumlah"]) * intval($material->pivot->jumlah))
                ]);
            }
        }

        $sell = Sell::create([
            "total_harga" => $request->transaksi["total_harga"],
            "total_barang" => $request->transaksi["total_barang"],
            "terbayar" => $request->transaksi["terbayar"],
            "kekurangan" => $request->transaksi["kekurangan"],
            "reseller_id" => $request->transaksi["reseller_id"],
            "user_id" => $request->transaksi["user_id"],
            "laba_bersih" => $laba,
            "laba_kotor" => $request->transaksi["total_harga"]
        ]);

        $sell->products()->sync($sync);

        return response()->json($sell, 200);
    }

    public function show(Sell $sell)
    {
        return view("sells.show", [
            "title" => "Sells",
            "sebit" => $sell,
            "saldo" => Account::latest()->limit(1)->get()
        ]);
    }

    public function edit(Sell $sell)
    {
        //
    }

    public function update(Request $request, Sell $sell)
    {
        //
    }

    public function destroy(Sell $sell)
    {
        //
    }
}
