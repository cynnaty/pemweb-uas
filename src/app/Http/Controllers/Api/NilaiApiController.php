<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai; 
use Illuminate\Http\Request;

class NilaiApiController extends Controller 
{
    /**
     * Mengambil semua data nilai beserta relasi peserta dan lomba.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $nilais = Nilai::with(['peserta', 'peserta.lomba'])->get();
            return response()->json($nilais); 
        } catch (\Exception $e) {
            \Log::error('Error fetching nilai data: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memuat data nilai.', 'error' => $e->getMessage()], 500);
        }
    }
}
