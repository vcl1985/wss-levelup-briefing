<?php

use App\Livewire\Admin\EmailSettings;
use App\Livewire\Admin\SubmissionsTable;
use App\Livewire\BriefingForm;
use Illuminate\Support\Facades\Route;

// Rota pública
Route::get('/', BriefingForm::class)->name('briefing.form');
Route::get('/briefing/{type}', BriefingForm::class)->name('briefing.form.type');

// Redireciona dashboard para admin
Route::get('/dashboard', function () {
    return redirect()->route('admin.submissions');
})->middleware(['auth'])->name('dashboard');

// Área admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.submissions');
    })->name('submissions');
    Route::get('/email-settings', EmailSettings::class)->name('email-settings');
});

require __DIR__.'/auth.php';