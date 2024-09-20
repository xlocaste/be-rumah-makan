<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $daftarMenu = Menu::with('rumah_makan')->get();

        return MenuResource::collection($daftarMenu);
    }

    public function store(MenuStoreRequest $request)
    {
        $menu = Menu::create([
            'nama' => $request -> nama,
            'kategori' => $request -> kategori,
            'rumah_makan_id' => $request -> rumah_makan_id,
        ]);

        return (new MenuResource($menu))->additional([
            'message' => 'Data berhasil di Buat'
        ]);
    }

    public function update(MenuUpdateRequest $request, Menu $menu)
    {
        $menu->update([
            'nama' => $request -> nama,
            'kategori' => $request -> kategori,
            'rumah_makan_id' => $request -> rumah_makan_id,
        ]);

        return (new MenuResource($menu))->additional([
            'message' => 'Data berhasil di Edit'
        ]);
    }

    public function show($menu)
    {
        $menu = Menu::findOrFail($menu);

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
}
