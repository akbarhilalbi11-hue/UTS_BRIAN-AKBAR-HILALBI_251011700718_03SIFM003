<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Electronic;

class CartController extends Controller
{
    // Menampilkan isi keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart', compact('cart', 'total'));
    }

    // Menambah produk ke keranjang
    public function add(Request $request, $id)
    {
        $product = Electronic::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "category" => $product->category
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Menghapus produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    // Menampilkan Form Pengiriman
    public function checkoutForm()
    {
        $cart = session()->get('cart');
        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    // Proses Data Pengiriman, Ongkir & Resi
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart');
        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index');
        }

        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $ongkir = 0;
        $kode_kurir = 'REG';
        if ($request->shipping_method == 'reguler') { $ongkir = 25000; $kode_kurir = 'REG'; }
        elseif ($request->shipping_method == 'express') { $ongkir = 50000; $kode_kurir = 'EXP'; }
        elseif ($request->shipping_method == 'cargo') { $ongkir = 100000; $kode_kurir = 'CAR'; }

        $biaya_layanan = 1000;
        $proteksi = $request->has('proteksi') ? 15000 : 0;
        $total = $subtotal + $ongkir + $biaya_layanan + $proteksi;
        
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $resiNumber = $kode_kurir . date('ymd') . rand(10000, 99999);

        $transactionData = [
            'invoice' => $invoiceNumber,
            'resi' => $resiNumber,
            'items' => $cart,
            'subtotal' => $subtotal,
            'ongkir' => $ongkir,
            'biaya_layanan' => $biaya_layanan,
            'proteksi' => $proteksi,
            'total' => $total,
            'date' => now(),
            'customer_name' => $request->name,
            'address' => $request->address,
            'shipping_method' => $request->shipping_method,
            'payment_method' => $request->payment_method,
        ];
        
        session()->flash('transaction', $transactionData);
        session()->forget('cart');

        return redirect()->route('cart.processing');
    }

    // Menampilkan Halaman Animasi Validasi Pembayaran
    public function processing()
    {
        if (!session()->has('transaction')) {
            return redirect()->route('electronics.index');
        }
        
        session()->reflash(); 
        return view('checkout-processing');
    }

    // Menampilkan Halaman Sukses & Resi
    public function success()
    {
        if (!session()->has('transaction')) {
            return redirect()->route('electronics.index');
        }

        $transaction = session()->get('transaction');
        return view('checkout-success', compact('transaction'));
    }
}