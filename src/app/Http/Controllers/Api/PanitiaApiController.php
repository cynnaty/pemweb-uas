<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Panitia; 
use Illuminate\Http\Request;

class PanitiaApiController extends Controller 
{
    /**
     * Mengambil semua data panitia.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $panitias = Panitia::all(); 
            return response()->json($panitias); 
        } catch (\Exception $e) {
            \Log::error('Error fetching panitia data: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memuat data panitia.', 'error' => $e->getMessage()], 500);
        }
    }
}