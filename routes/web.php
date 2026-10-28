<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortofolioController;

// Halaman 1: Dashboard / CV Tampilan Depan
Route::get('/', [PortofolioController::class, 'index'])->name('dashboard');

// Halaman 2: Form Kelola & Manajemen CRUD
Route::get('/admin', [PortofolioController::class, 'admin'])->name('admin');

// Action CRUD Portofolio
Route::post('/portofolio', [PortofolioController::class, 'storePortofolio'])->name('portofolio.store');
Route::put('/portofolio/{id}', [PortofolioController::class, 'updatePortofolio'])->name('portofolio.update');
Route::delete('/portofolio/{id}', [PortofolioController::class, 'destroyPortofolio'])->name('portofolio.destroy');

// Action CRUD Skill
Route::post('/skill', [PortofolioController::class, 'storeSkill'])->name('skill.store');
Route::delete('/skill/{id}', [PortofolioController::class, 'destroySkill'])->name('skill.destroy');
