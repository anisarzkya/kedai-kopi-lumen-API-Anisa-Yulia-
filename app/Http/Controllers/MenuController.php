<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Menu::query();

        // Filter by outlet_id jika query parameter diberikan
        if ($request->has('outlet_id') && $request->query('outlet_id') !== '') {
            $query->where('outlet_id', $request->query('outlet_id'));
        }

        $menus = $query->get()->toArray();

        return $this->sendResponse($request, [
            'status' => 'success',
            'data'   => $menus
        ]);
    }

    public function show(Request $request, $menuId)
    {
        $menu = Menu::find($menuId);

        if (!$menu) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        return $this->sendResponse($request, [
            'status' => 'success',
            'data'   => $menu->toArray()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'outlet_id' => 'required|exists:outlets,id',
            'nama_menu' => 'required',
            'kategori'  => 'required|in:coffee,non-coffee,snack,main-course',
            'harga'     => 'required|integer',
            'tersedia'  => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()->toArray()
            ], 422);
        }

        $menu = Menu::create($request->all());

        return $this->sendResponse($request, [
            'status'  => 'success',
            'message' => 'Menu berhasil ditambahkan',
            'data'    => $menu->toArray()
        ], 201);
    }

    public function update(Request $request, $menuId)
    {
        $menu = Menu::find($menuId);

        if (!$menu) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'outlet_id' => 'sometimes|exists:outlets,id',
            'kategori'  => 'sometimes|in:coffee,non-coffee,snack,main-course',
            'harga'     => 'sometimes|integer',
            'tersedia'  => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()->toArray()
            ], 422);
        }

        $menu->update($request->all());

        return $this->sendResponse($request, [
            'status'  => 'success',
            'message' => 'Menu berhasil diperbarui',
            'data'    => $menu->toArray()
        ]);
    }

    public function destroy(Request $request, $menuId)
    {
        $menu = Menu::find($menuId);

        if (!$menu) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        $menu->delete();

        return $this->sendResponse($request, [
            'status'  => 'success',
            'message' => 'Menu berhasil dihapus'
        ]);
    }
}
