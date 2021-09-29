<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;

// Views
Route::get( "/",[ SummaryController::class, "index" ]  );
