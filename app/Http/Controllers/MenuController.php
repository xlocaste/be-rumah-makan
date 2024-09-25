<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Models\RumahMakan;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index($rumahMakan)
    {
        $daftarMenu = Menu::with('rumah_makan')->where('rumah_makan_id', $rumahMakan)->get();

        return MenuResource::collection($daftarMenu);
    }

    public function store(MenuStoreRequest $request)
    {
        $menu = Menu::create([
            'nama' => $request -> nama,
            'kategori' => $request -> kategori,
            'stok' => $request -> stok,
            'rumah_makan_id' => $request -> rumah_makan_id,
        ]);

        return (new MenuResource($menu))->additional([
            'message' => 'Data berhasil di Buat'
        ]);
    }

    public function update(MenuUpdateRequest $request, $rumahMakanId, Menu $menu)
    {
        $rumahMakan = RumahMakan::findOrFail($rumahMakanId);

        $menu->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'rumah_makan_id' => $rumahMakan->id,
        ]);

        return (new MenuResource($menu))->additional([
            'message' => 'Data berhasil di Edit'
        ]);
    }


    public function show($rumahMakan, $menu)
    {
        $rumahMakan = RumahMakan::findOrFail($rumahMakan);

        $menu = Menu::where('id', $menu)->where('rumah_makan_id', $rumahMakan->id)->firstOrFail();

        return (new MenuResource($menu))->additional([
            'message' => 'Data berhasil di Dapatkan'
        ]);
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return response()->json([
            'message' => 'Data berhasil di Hapus'
        ]);
    }

    public function pesan($menuId, Request $request)
    {
        $request->validate([
            'jumlah_pesan' => 'required|integer|min:1',
        ]);

        $jumlah_pesan = $request->input('jumlah_pesan');

        $menu = Menu::find($menuId);

        $menu->stok -= $request->jumlah_pesan;
        $menu->save();

        return (new MenuResource($menu))->additional([
            'message' => 'Berhasil Memesan'
        ]);
    }
}
