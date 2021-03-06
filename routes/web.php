<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SummaryStatusController;
use App\Http\Controllers\AuthController;

Route::get( "/", [ SummaryController::class, "index" ] )
    ->middleware( "auth.roles:admin,hr" )
    ->name( "dashboard" );

// Summaries
Route::prefix('/summaries')->middleware( "auth.roles:admin,hr" )->group(function(){
    Route::get( "/create",[ SummaryController::class, "create" ]  )->name('createNewCV');
    Route::prefix('/{id}')->group(function(){
        //views
        Route::get( "/edit", [ SummaryController::class, "edit" ] )->name( "summaries_edit" );
        Route::get("/pdf", [ SummaryController::class, "pdf"])->name("pdf");
        Route::get( "/",[ SummaryController::class, "view" ]  )->name( "summaries_one" );
        //actions
        Route::put( "/update", [ SummaryController::class, "update" ] )->name("summaryUpdate");
        Route::post( "/update", [ SummaryController::class, "store" ] )->name("summaryStore");
    });

    Route::get("/", function (){
        return redirect(route("dashboard"));
    });
});

Route::middleware( "auth.roles:admin" )->group( function(){
    // Admin
    Route::get( "/admin", [ AdminController::class, "index" ] )->name( "admin" );

    //Users
    Route::prefix("/users")->group(function(){
        Route::get("/", [UserController::class, "index"])->name("users_all");
        Route::get("/create", [UserController::class, "create"])->name("users_create");
        Route::get("/{user}/edit", [UserController::class, "edit"])->name("users_edit");

        Route::post( "/", [ UserController::class, "store" ] )->name( "users_store" );
        Route::put( "/{user}", [ UserController::class, "update" ] )->name( "users_update" );
        Route::delete( "/{user}", [ UserController::class, "destroy" ] )->name( "users_destroy" );
    });

    // ????????
    Route::prefix( "/roles" )->group( function(){
        Route::get( "/", [ RoleController::class, "index" ] )->name( "roles_all" );
        Route::post( "/", [ RoleController::class, "store" ] )->name( "roles_store" );
        Route::put( "/{role}", [ RoleController::class, "update" ] )->name( "roles_update" );
        Route::delete( "/{role}", [ RoleController::class, "delete" ] )->name( "roles_delete" );
    } );

    // Positions
    Route::prefix("/positions")->group(function(){
        Route::get( "/", [ PositionController::class, "index" ] )->name( "positions_all" );
        Route::post( "/", [ PositionController::class, "create" ] )->name( "new_position" );
        Route::delete(  "/{position}", [ PositionController::class, "delete" ] )->name( "delete_position" );
        Route::put(  "/{position}", [ PositionController::class, "update" ] )->name( "update_position" );
    });

    // Levels
    Route::prefix("/levels")->group(function(){
        Route::get( "/", [ LevelController::class, "index" ] )->name( "levels_all" );
        Route::post( "/", [ LevelController::class, "create" ] )->name( "new_level" );
        Route::delete(  "/{level}", [ LevelController::class, "delete" ] )->name( "delete_level" );
        Route::put(  "/{level}", [ LevelController::class, "update" ] )->name( "update_level" );
    });

    // Summary statuses
    Route::prefix("/summary_statuses")->group(function(){
        Route::get( "/", [ SummaryStatusController::class, "index" ] )->name( "summary_statuses_all" );
        Route::post( "/", [ SummaryStatusController::class, "create" ] )->name( "new_summary_status" );
        Route::delete(  "/{summary_status}", [ SummaryStatusController::class, "delete" ] )->name( "delete_summary_status" );
        Route::put(  "/{summary_status}", [ SummaryStatusController::class, "update" ] )->name( "update_summary_status" );
    });
} );

Route::delete( "/summaries/{summary}", [ SummaryController::class, "destroy" ] )
    ->middleware( "auth.roles:admin,hr" )
    ->name( "summaries_destroy" );

Route::put(
    "/summaries/{summary}/status",
    [ SummaryController::class, "updateStatus" ]
)->middleware( "auth.roles:admin,hr" )->name( "summaries_update_status" );

// Auth views
Route::get( "/login", [ AuthController::class, "login" ] )->name( "login" );

// Auth actions
Route::post( "/sign_in", [ AuthController::class, "signIn" ] )->name( "signIn" );
Route::get( "/sign_out", [ AuthController::class, "signOut" ] )->name( "signOut" );
