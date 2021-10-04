<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\AdminLevelDeleteRequest;
use App\Http\Requests\AdminLevelRequest;
use App\Models\Level;
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

    public function create( AdminLevelRequest $request ){
        $level = new Level();
        $level->fill(["name" => $request->get("name")])
            ->save();
    }

    public function update( AdminLevelRequest $request, Level $level){
        $level
            ->fill(["name" => $request->get("name")])
            ->save();
    }

    public function delete( AdminLevelDeleteRequest $request, Level $level ){
        $level->delete();
    }
}
