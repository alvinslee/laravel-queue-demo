<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('reports.index');
});

Route::resource('reports', ReportController::class);
