<?php

namespace App\Http\Controllers;

use App\Models\Barangkeluar;
use App\Models\Barangmasuk;
use App\Models\Databarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DatakeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brg = Barangkeluar::get();
        return view('pegawai.databarangkeluar.index',compact('brg'));
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
        return view('pegawai.databarangkeluar.create', compact('namabrg', 'tampildata', 'jumlah', 'date'));
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
        $barangkeluar = new Barangkeluar();
        $barangkeluar->nama_barang = json_encode($request->input('nama_barang'));
        $barangkeluar->jumlah = json_encode($request->input('jumlah'));
        $barangkeluar->totalharga = json_encode($request->input('totalharga'));
        $barangkeluar->tanggal_keluar = $request->input('tanggal_keluar');
        $barangkeluar->keterangan = $request->input('keterangan');
        $barangkeluar->save();
        Session::flash('successsubmit','Data berhasil di Tambahkan');
        return redirect('databarangkeluar/create');
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
        $brg = Barangkeluar::find($id);
        $namaBarang = json_decode($brg->nama_barang);
        $jumlah = json_decode($brg->jumlah);
        return view('pegawai.databarangkeluar.edit', compact('brg', 'namaBarang', 'jumlah'));
    }

    public function editbarangkel($id,$nama,$jumlah,$totalharga,$tgl,$ket)
    {
        $brg = Barangkeluar::find($id);
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

    public function destroybarangkel($id,$nama)
    {
        $barangMasuk = Barangkeluar::find($id);
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
