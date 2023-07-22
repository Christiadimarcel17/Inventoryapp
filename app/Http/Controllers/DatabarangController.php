<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use Illuminate\Http\Request;

class DatabarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $databarang = Databarang::all();
       // $latestItem = Databarang::orderBy('id', 'desc')->first(); // Mendapatkan item terakhir berdasarkan kode unik

        return view('pegawai.databarang.index',compact('databarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = new Databarang();
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->supplier = $request->supplier;
        $barang->harga = str_replace('.','',$request->harga);
        $barang->satuan = $request->satuan;
        $barang->keterangan = $request->keterangan;
        $barang->save();
        return response()->json(
            [
                'success'=>true,
                'message'=>'Barang berhasil di simpan'
            ]
        );
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
        $barang = Databarang::find($id);
        return response()->json($barang);
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
        $barang = Databarang::find($id);
        $editData = [
            'nama_barang'=> $request->nama_barang,
            'supplier'=> $request->supplier,
            'harga'=> $request->harga,
            'satuan'=> $request->satuan,
            'keterangan'=> $request->keterangan,

        ];


        $barang->update($editData);
                return response()->json([
                    'success' => true,
                    'message' => 'Update Sukses'
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Databarang::find($id);
    	$barang->delete();
        return response()->json(['success'=>'Barang berhasil di hapus']);
    }
}
