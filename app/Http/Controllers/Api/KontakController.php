<?php

namespace App\Http\Controllers\Api;

use App\Models\Kontak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    public function index()
    {
        // all kontak
        $kontaks = Kontak::all();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diambil',
            'data' => $kontaks
        ], 201);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $kontak = Kontak::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Kontak berhasil ditambahkan',
            'data' => $kontak
        ], 201);
    }

    public function show(string $id)
    {
        // detail data kontak (id)
        $kontak = Kontak::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Data kontak berhasil diambil',
            'data' => $kontak
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        // update data kontak (id)
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $kontak = Kontak::findOrFail($id);
        $kontak->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Kontak berhasil diupdate',
            'data' => $kontak
        ], 200);
    }

    public function destroy(string $id)
    {
        // delete data kontak (id)
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();
        return response()->json([
            'status' => true,
            'message' => 'Kontak berhasil dihapus',
            'data' => $kontak
        ], 204);
    }
}
