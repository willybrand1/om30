<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(PacienteController::class)->group(function () {
    Route::get('/paciente/list', [PacienteController::class, 'listPacientes'])->name('paciente.list');
    Route::get('/paciente/{id}', [PacienteController::class, 'showPaciente'])->name('paciente.show');
    Route::post('/paciente/create', [PacienteController::class, 'createPaciente'])->name('paciente.create');
    Route::put('/paciente/{id}/update', [PacienteController::class, 'updatePaciente'])->name('paciente.update');
    Route::delete('/paciente/{id}/deletar', [PacienteController::class, 'deletePaciente'])->name('paciente.delete');
});
