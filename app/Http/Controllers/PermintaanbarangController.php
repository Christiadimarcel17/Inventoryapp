<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\Permintaanbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermintaanbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Databarang::all();
        $date = date('Y-m-d');
        $datapermintaan = DB::table('request_barang as rb')
                ->select('rb.kode_req_barang','rb.tanggal_req','br.nama_barang','rb.keterangan','br.kode_barang','rb.status','rb.id')
                ->leftJoin('barang as br', 'br.id', '=', 'rb.nama_barang')
                ->get();

        return view('pegawai.reqbarang.index',compact('barang','date','datapermintaan'));
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
        $barang = new Permintaanbarang();
        $barang->nama_barang = $request->nama_barang;
        $barang->tanggal_req = $request->tanggal_req;
        $barang->keterangan = $request->keterangan;
        $barang->save();
        return response()->json(
            [
                'success'=>true,
                'message'=>'Permintaan berhasil di simpan'
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
        $barang = Permintaanbarang::find($id);
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
        $barang = Permintaanbarang::find($id);
        $editData = [
            'nama_barang'=> $request->nama_barang,
            'tanggal_req'=> $request->tanggal_req,
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
        $barang = Permintaanbarang::find($id);
    	$barang->delete();
        return response()->json(['success'=>'Barang berhasil di hapus']);
    }
}
