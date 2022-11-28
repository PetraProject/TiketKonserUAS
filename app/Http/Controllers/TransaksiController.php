<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $admin = transaksi::get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Transaksi',
            'data' => $admin
        ], 200);
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
        $store = Validator::make($request->all(), [
            'id_tiket' => 'required',
            'jumlah_tiket' => 'required',
            'total_bayar_tiket' => 'required',
            'tanggal_bayar_tiket' => 'required'
        ]);

        if ($store->fails()){
            return response()->json([
                'success' => false,
                'CODE' => 400,
                'message' => 'Gagal Menambahkan Data Transaksi',
                'data' => $store->errors()
            ], 400);
        } 

        $validated = $store->validated();

        $admin = transaksi::create($validated);

        return response()->json([
            "message" => "Tambah Data Transaksi Berhasil",
            "Code" => 200,
            "data" => $admin
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = transaksi::find($id);
        
        if ($table) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Transaksi',
                'data' => $table
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Transaksi Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $admin = transaksi::find($id);

        if (!$admin) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Data Transaksi Tidak Ditemukan'
            ], 404);
        }

        $update = Validator::make($request->all(), [
            'id_tiket' => 'required',
            'jumlah_tiket' => 'required',
            'total_bayar_tiket' => 'required',
            'tanggal_bayar_tiket' => 'required'
        ]);

        if ($update->fails()){
            return response()->json([
                'success' => false,
                'CODE' => 400,
                'message' => 'Gagal Mengubah Data',
                'data' => $update->errors()
            ], 400);
        }

        $validated = $update->validated();

        $admin->update($validated);

        return response()->json([
            "message" => "Sukses Memperbaharui Data Transaksi",
            "Code" => 200,
            "data" => $admin
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = transaksi::find($id);
        if($data){
            $data->delete();
            return["message" => "Sukses Hapus Data Transaksi"];
        }else{
            return["message" => "Data Tidak Ditemukan"];
        }
    }
}

