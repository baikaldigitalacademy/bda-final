<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLevelDeleteRequest;
use App\Http\Requests\AdminLevelRequest;
use App\Models\Level;
use Illuminate\Contracts\View\View;
use App\Repositories\LevelRepository;
use Illuminate\Database\QueryException;

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

        return view( "directories.simple", [
            "data" => $levels,
            "directoryName" => "Уровни",
            "baseUrl" => url( "/levels" )
        ] );
    }

    public function create( AdminLevelRequest $request ){
        $level = new Level();
        $level->fill(["name" => $request->get("name")])
            ->save();

        return $level->id;
    }

    public function update( AdminLevelRequest $request, Level $level){
        $level
            ->fill(["name" => $request->get("name")])
            ->save();
    }

    public function delete( AdminLevelDeleteRequest $request, Level $level ){
        try{
            $level->delete();
        }catch (QueryException $e){
            return response('I cannot delete a dependent field.', 400);
        }
    }
}
