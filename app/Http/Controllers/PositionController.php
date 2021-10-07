<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminPositionDeleteRequest;
use App\Http\Requests\AdminPositionRequest;
use App\Models\Position;
use Illuminate\Contracts\View\View;
use App\Repositories\PositionRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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

        return view( "directories.simple", [
            "data" => $positions,
            "directoryName" => "Позиции",
            "baseUrl" => url( "/positions" )
        ] );
    }

    public function create( AdminPositionRequest $request ){
        $position = new Position();
        $position->fill(["name" => $request->get("name")])
            ->save();

        return $position->id;
    }

    public function update( AdminPositionRequest $request, Position $position){
        $position
            ->fill(["name" => $request->get("name")])
            ->save();
    }

    public function delete( AdminPositionDeleteRequest $request, Position $position ){
        try {
            $position->delete();
        }catch (QueryException $exception){
            return response(
                "Cannot delete or update a parent row: a foreign key constraint fails.",
                400);
        }
    }
}
