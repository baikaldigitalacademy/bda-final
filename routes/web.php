<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;

// Views
Route::get( "/",[ SummaryController::class, "index" ]  );
Route::get( "summaries/{id}",[ SummaryController::class, "view" ]  );

// Actions
Route::delete( "/summaries/{summary}", [ SummaryController::class, "destroy" ] );
