<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Electronic;

class ElectronicController extends Controller
{
    // Menampilkan halaman katalog utama
    public function index()
    {
        // Mengambil semua data dari database, diurutkan dari yang terbaru
        $electronics = Electronic::latest()->get();
        
        return view('electronics.index', compact('electronics'));
    }

    // Menampilkan halaman detail produk
    public function show($id)
    {
        // Mencari data berdasarkan ID, otomatis menghasilkan error 404 jika tidak ditemukan
        $electronic = Electronic::findOrFail($id);
        
        return view('electronics.show', compact('electronic'));
    }
}