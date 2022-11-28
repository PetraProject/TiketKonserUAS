<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tiket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = tiket::get();

        return response()->json([
            'success' => true,
            'message' => 'List Semua Tiket',
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
            'nama_tiket' => 'required',
            'tanggal_tiket' => 'required',
            'harga_tiket' => 'required'
        ]);

        if ($store->fails()){
            return response()->json([
                'success' => false,
                'CODE' => 400,
                'message' => 'Gagal Menambahkan Data Tiket',
                'data' => $store->errors()
            ], 400);
        } 

        $validated = $store->validated();

        $admin = tiket::create($validated);

        return response()->json([
            "message" => "Tambah Data Tiket Berhasil",
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
        $table = tiket::find($id);
        
        if ($table) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Tiket',
                'data' => $table
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Tiket Tidak Ditemukan',
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
        $admin = tiket::find($id);

        // $admin = Concert::find($id);

        if (!$admin) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $validator = validator::make($request->all(), [
            'nama_tiket' => 'required|string',
            'tanggal_tiket' => 'required|date',
            'harga_tiket' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 402,
                'status' => 'error',
                'message' => $validator->errors()
            ], 402);
        }

        $validated = $validator->getData();

        $admin->update($validated);

        return response()->json([
            'code' => 202,
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $admin
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
        $data = tiket::find($id);
        if($data){
            $data->delete();
            return["message" => "Sukses Hapus Data Tiket"];
        }else{
            return["message" => "Data Tidak Ditemukan"];
        }
    }
}
