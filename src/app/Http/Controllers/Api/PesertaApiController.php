<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peserta; 
use App\Models\Nilai;   
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PesertaApiController extends Controller
{
    /**
     * Mengambil semua data peserta.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $pesertas = Peserta::with('lomba')->get();
            return response()->json($pesertas);
        } catch (\Exception $e) {
            \Log::error('Error fetching peserta data: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal memuat data peserta.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Menyimpan data peserta baru ke database dan membuat entri nilai default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:pesertas,email|max:255', 
                'asal_sekolah' => 'required|string|max:255',
                'lomba_id' => 'required|exists:lombas,id', 
            ]);

            $peserta = Peserta::create($validatedData);

            Nilai::create([
                'peserta_id' => $peserta->id,
                'juri' => 'Belum Dinilai', 
                'skor' => 0,              
                'komentar' => 'Menunggu penilaian juri.', 
            ]);

            return response()->json(['message' => 'Pendaftaran peserta berhasil dan nilai default ditambahkan!', 'peserta' => $peserta], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Error storing peserta data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan server.', 'error' => $e->getMessage()], 500);
        }
    }
}
