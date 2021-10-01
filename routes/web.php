<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;

// Views
Route::get( "/", [ SummaryController::class, "index" ] )->name( "dashboard" );
Route::get( "summaries/{id}",[ SummaryController::class, "view" ]  )->name( "summaries_one" );

// Actions
Route::delete( "/summaries/{summary}", [ SummaryController::class, "destroy" ] )->name( "summaries_destroy" );
