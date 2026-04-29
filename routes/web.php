<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

/* ── HOME ─────────────────────────────────────────────────────────────────── */
Route::get('/', [FrontController::class, 'home'])->name('home');

/* ── PARTNER LANDINGS ────────────────────────────────────────────────────── */
Route::get('/aspel',          [FrontController::class, 'partner'])->defaults('brand', 'aspel')->name('partner.aspel');
Route::get('/soft-restaurant',[FrontController::class, 'partner'])->defaults('brand', 'softrestaurant')->name('partner.soft');
Route::get('/zoho',           [FrontController::class, 'partner'])->defaults('brand', 'zoho')->name('partner.zoho');
Route::get('/microsoft-365',  [FrontController::class, 'partner'])->defaults('brand', 'microsoft')->name('partner.microsoft');

/* ── PRODUCT DETAIL (PDP) ────────────────────────────────────────────────── */
Route::get('/{brand}/contabilidad/{product}', [FrontController::class, 'pdp'])->name('pdp');

/* ── MISC ─────────────────────────────────────────────────────────────────── */
Route::get('/agenda-tu-cita', fn() => 'Próximamente')->name('booking');
