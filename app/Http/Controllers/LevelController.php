<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Repositories\LevelRepository;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param LevelRepository $levelRepository
     *
     * @return View
     */
    public function index( LevelRepository $levelRepository ): View
    {
        $levels = $levelRepository->getAll();

        return view( "simple_directory", [
            "data" => $levels,
            "directoryName" => "Уровни",
            "baseUrl" => url( "/levels" )
        ] );
    }
}
