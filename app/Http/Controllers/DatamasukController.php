<?php

namespace App\Http\Controllers;

use App\Models\Barangmasuk;
use App\Models\Databarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DatamasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $brg = Barangmasuk::first();
        $brg = Barangmasuk::get();
        return view('pegawai.databarangmasuk.index', compact('brg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $nama_barang = $request->input('nama_barang');
        $jumlah = $request->input('jumlah');
        $tampildata = Databarang::where('id', $nama_barang)->get();
        $namabrg = Databarang::all();
        $date = date('Y-m-d');
        return view('pegawai.databarangmasuk.create', compact('namabrg', 'tampildata', 'jumlah', 'date'));
    }

    public function tampilkan(Request $request)
    {
        $nama_barang = $request->input('nama_barang');
        $tampildata = Databarang::where('id', $nama_barang)->get();
        return response()->json($tampildata);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barangmasuk = new Barangmasuk();
        $barangmasuk->nama_barang = json_encode($request->input('nama_barang'));
        $barangmasuk->jumlah = json_encode($request->input('jumlah'));
        $barangmasuk->totalharga = json_encode($request->input('totalharga'));
        $barangmasuk->tanggal_masuk = $request->input('tanggal_masuk');
        $barangmasuk->keterangan = $request->input('keterangan');
        $barangmasuk->save();
        Session::flash('successsubmit','Data berhasil di Tambahkan');
        return redirect('databarangmasuk/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brg = Barangmasuk::find($id);
        //     $tes =explode( ",",$brg['nama_barang']);
        // dd($tes[0]);
        $namaBarang = json_decode($brg->nama_barang);
        $jumlah = json_decode($brg->jumlah);
        // dd($namaBarang);
        return view('pegawai.databarangmasuk.edit', compact('brg', 'namaBarang', 'jumlah'));
    }

    //menampilkan edit data yang berbentu json di dalam database
    public function editbarang($id, $nama, $jumlah, $totalharga, $tgl, $ket)
    {
        $brg = Barangmasuk::find($id);
        return view('pegawai.databarangmasuk.edit', compact('brg', 'nama', 'jumlah', 'totalharga', 'tgl', 'ket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function destroybarang($id, $nama)
    {
        $barangMasuk = Barangmasuk::find($id);
        $namaBarang = json_decode($barangMasuk->nama_barang);

        // Temukan indeks data yang sesuai dengan nama barang
        $index = array_search($nama, $namaBarang);
        if ($index !== false) {
            // Hapus data sesuai indeks
            unset($namaBarang[$index]);
        }
        //jika nama sudah kosong hapus semua data di kolom
        if (empty($namaBarang)) {
            $barangMasuk->delete();
        } else {
            // Perbarui data nama barang setelah penghapusan
            $barangMasuk->nama_barang = json_encode(array_values($namaBarang));
            $barangMasuk->save();
        }

        return back();
    }
}
