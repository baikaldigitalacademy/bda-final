<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;

// Views
Route::get( "/",[ SummaryController::class, "index" ]  );

Route::prefix('/summaries')->group(function(){
    Route::get( "/edit",[ SummaryController::class, "create" ]  )->name('createNewCV');
    Route::prefix('/{id}')->group(function(){
        Route::get( "/edit", [ SummaryController::class, "edit" ] );
        Route::put( "/update", [ SummaryController::class, "update" ] )->name("summaryUpdate");
        Route::get( "/",[ SummaryController::class, "view" ]  );
    });
});

// Actions
Route::delete( "/summaries/{summary}", [ SummaryController::class, "destroy" ] );
