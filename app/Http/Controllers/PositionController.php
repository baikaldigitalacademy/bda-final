<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Repositories\PositionRepository;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PositionRepository $positionRepository
     *
     * @return View
     */
    public function index( PositionRepository $positionRepository ): View
    {
        $positions = $positionRepository->getAll();

        return view( "simple_directory", [
            "data" => $positions,
            "directoryName" => "Позиции",
            "baseUrl" => url( "/positions" )
        ] );
    }
}
