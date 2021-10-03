<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\AdminPositionDeleteRequest;
use App\Http\Requests\AdminPositionRequest;
use App\Models\Position;
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

    public function create( AdminPositionRequest $request ){
        $position = new Position();
        $position->fill(["name" => $request->get("name")])
            ->save();
        return response("Created", 200);
    }

    public function update( AdminPositionRequest $request, Position $position){
        $position
            ->fill(["name" => $request->get("name")])
            ->save();
        return response("Updated", 200);
    }

    public function delete( AdminPositionDeleteRequest $request, Position $position ){
        $position->delete();
        return response("Deleted", 200);
    }
}
