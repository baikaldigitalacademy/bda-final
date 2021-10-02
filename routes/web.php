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
    Route::get( "/create",[ SummaryController::class, "create" ]  )->name('createNewCV');
    Route::prefix('/{id}')->group(function(){
        //views
        Route::get( "/edit", [ SummaryController::class, "edit" ] )->name( "summaries_edit" );
        Route::get("/pdf", [ SummaryController::class, "pdf"])->name("pdf");
        Route::get( "/",[ SummaryController::class, "view" ]  )->name( "summaries_one" );
        //actions
        Route::put( "/update", [ SummaryController::class, "update" ] )->name("summaryUpdate");
        Route::post( "/update", [ SummaryController::class, "store" ] )->name("summaryUpdate");
    });

    Route::get("/", function (){
        return redirect(route("dashboard"));
    });
});

Route::get( "/admin", [ AdminController::class, "index" ] )->name( "admin" );

Route::get( "/positions", [ PositionController::class, "index" ] )->name( "positions_all" );

Route::get( "/levels", [ LevelController::class, "index" ] )->name( "levels_all" );

Route::get( "/summary_statuses", [ SummaryStatusController::class, "index" ] )->name( "summary_statuses_all" );

// Actions
Route::delete( "/summaries/{summary}", [ SummaryController::class, "destroy" ] )->name( "summaries_destroy" );
