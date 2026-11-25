<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OutletController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $outlets = Outlet::all()->toArray();

        return $this->sendResponse($request, [
            'status' => 'success',
            'data'   => $outlets
        ]);
    }

    public function show(Request $request, $outletId)
    {
        $outlet = Outlet::find($outletId);

        if (!$outlet) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Outlet tidak ditemukan'
            ], 404);
        }

        return $this->sendResponse($request, [
            'status' => 'success',
            'data'   => $outlet->toArray()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_outlet'     => 'required|unique:outlets,kode_outlet',
            'nama_outlet'     => 'required',
            'alamat'          => 'required',
            'kota'            => 'required',
            'no_telepon'      => 'required',
            'email'           => 'required|email',
            'nama_manager'    => 'required',
            'jam_buka'        => 'required',
            'jam_tutup'       => 'required',
            'kapasitas_kursi' => 'required|integer',
            'status'          => 'in:buka,tutup'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()->toArray()
            ], 422);
        }

        $outlet = Outlet::create($request->all());

        return $this->sendResponse($request, [
            'status'  => 'success',
            'message' => 'Outlet berhasil ditambahkan',
            'data'    => $outlet->toArray()
        ], 201);
    }

    public function update(Request $request, $outletId)
    {
        $outlet = Outlet::find($outletId);

        if (!$outlet) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Outlet tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'kode_outlet'     => 'sometimes|unique:outlets,kode_outlet,' . $outletId,
            'email'           => 'sometimes|email',
            'kapasitas_kursi' => 'sometimes|integer',
            'status'          => 'sometimes|in:buka,tutup'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()->toArray()
            ], 422);
        }

        $outlet->update($request->all());

        return $this->sendResponse($request, [
            'status'  => 'success',
            'message' => 'Outlet berhasil diperbarui',
            'data'    => $outlet->toArray()
        ]);
    }

    public function destroy(Request $request, $outletId)
    {
        $outlet = Outlet::find($outletId);

        if (!$outlet) {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Outlet tidak ditemukan'
            ], 404);
        }

        $outlet->delete();

        return $this->sendResponse($request, [
            'status'  => 'success',
            'message' => 'Outlet berhasil dihapus'
        ]);
    }
}
