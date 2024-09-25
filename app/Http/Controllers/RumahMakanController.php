<?php

namespace App\Http\Controllers;

use App\Http\Requests\RumahMakanStoreRequest;
use App\Http\Requests\RumahMakanUpdateRequest;
use App\Http\Resources\RumahMakanResource;
use App\Models\RumahMakan;

class RumahMakanController extends Controller
{
    public function index()
    {
        $daftarRumahMakan = RumahMakan::get();

        return RumahMakanResource::collection($daftarRumahMakan);
    }

    public function store(RumahMakanStoreRequest $request)
    {
        $rumahMakan = RumahMakan::create([
            'nama' => $request -> nama,
            'alamat' => $request -> alamat,
            'jam_buka' => $request -> jam_buka,
            'jam_tutup' => $request -> jam_tutup,
        ]);

        return (new RumahMakanResource($rumahMakan))->additional([
            'message' => 'Data berhasil di Tmabahkan'
        ]);
    }

    public function update(RumahMakanUpdateRequest $request, RumahMakan $rumahMakan)
    {
        $rumahMakan->update([
            'nama' => $request -> nama,
            'alamat' => $request -> alamat,
            'jam_buka' => $request -> jam_buka,
            'jam_tutup' => $request -> jam_tutup,
            'status' => $request -> status,
        ]);

        return (new RumahMakanResource($rumahMakan))->additional([
            'message' => 'Data berhasil di Update'
        ]);
    }

    public function show($rumahMakan)
    {
        $rumahMakan = RumahMakan::findOrFail($rumahMakan);

        return (new RumahMakanResource($rumahMakan))->additional([
            'message' => 'Data berhasil di dapatkan'
        ]);
    }

    public function destroy(RumahMakan $rumahMakan)
    {
        $rumahMakan->delete();

        return response()->json([
            'message' => 'Data berhasil di Hapus'
        ]);
    }
}
