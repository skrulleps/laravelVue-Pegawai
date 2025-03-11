<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\EselonController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\KelaminController;
use App\Http\Controllers\AuthController;

Route::prefix('api')->group(function () {
    // Auth routes
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });

    // Pegawai routes
    Route::apiResource('pegawai', PegawaiController::class)->parameters([
        'pegawai' => 'id_pegawai'
    ]);

    // Master data routes
    Route::apiResources([
        'golongan' => GolonganController::class,
        'jabatan' => JabatanController::class,
        'eselon' => EselonController::class,
        'unit-kerja' => UnitKerjaController::class,
        'agama' => AgamaController::class,
        'kelamin' => KelaminController::class,
    ], [
        'parameters' => [
            'golongan' => 'id_golongan',
            'jabatan' => 'id_jabatan',
            'eselon' => 'id_eselon',
            'unit-kerja' => 'id_unit',
            'agama' => 'id_agama',
            'kelamin' => 'id_kelamin',
        ]
    ]);
});
