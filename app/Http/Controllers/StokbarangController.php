<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Databarang;

class StokbarangController extends Controller
{
    public function index()
    {
        $databarang = Databarang::all();
       //$latestItem = Databarang::orderBy('id', 'desc')->first(); // Mendapatkan item terakhir berdasarkan kode unik

        return view('pegawai.stokbarang.index',compact('databarang'));
    }
}
