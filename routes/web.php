<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SummaryStatusController;

// Views
Route::get( "/", [ SummaryController::class, "index" ] )->name( "dashboard" );

Route::prefix('/summaries')->group(function(){
    Route::get( "/edit",[ SummaryController::class, "create" ]  )->name('createNewCV');
    Route::prefix('/{id}')->group(function(){
        Route::get( "/edit", [ SummaryController::class, "edit" ] );
        Route::put( "/update", [ SummaryController::class, "update" ] )->name("summaryUpdate");
        Route::get( "/",[ SummaryController::class, "view" ]  )->name( "summaries_one" );
    });
});

Route::get( "/admin", [ AdminController::class, "index" ] )->name( "admin" );

Route::get( "/positions", [ PositionController::class, "index" ] )->name( "positions_all" );

Route::get( "/levels", [ LevelController::class, "index" ] )->name( "levels_all" );

Route::get( "/summary_statuses", [ SummaryStatusController::class, "index" ] )->name( "summary_statuses_all" );

// Actions
Route::delete( "/summaries/{summary}", [ SummaryController::class, "destroy" ] )->name( "summaries_destroy" );
