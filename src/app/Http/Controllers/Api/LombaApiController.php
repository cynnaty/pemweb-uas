<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lomba;

/**
 * @OA\Get(
 *     path="/api/lomba",
 *     summary="Ambil semua data lomba",
 *     tags={"Lomba"},
 *     @OA\Response(
 *         response=200,
 *         description="Berhasil mengambil data lomba",
 *         @OA\JsonContent(type="array", @OA\Items(
 *             @OA\Property(property="id", type="integer"),
 *             @OA\Property(property="nama", type="string"),
 *             @OA\Property(property="tanggal", type="string", format="date"),
 *             @OA\Property(property="lokasi", type="string"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time"),
 *         ))
 *     )
 * )
 */
class LombaApiController extends Controller
{
    public function index()
    {
        return response()->json(Lomba::all());
    }
}
