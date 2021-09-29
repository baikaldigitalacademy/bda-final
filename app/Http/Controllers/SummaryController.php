<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Http\Requests\SummaryGetAllRequest;
use App\Models\Summary;
use App\Repositories\SummaryRepository;
use App\Repositories\PositionRepository;
use App\Repositories\LevelRepository;
use App\Repositories\SummaryStatusRepository;

class SummaryController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param SummaryGetAllRequest $request
     * @param SummaryRepository $summaryRepository
     * @param PositionRepository $positionRepository
     * @param LevelRepository $levelRepository
     * @param SummaryStatusRepository $summaryStatusRepository
     *
     * @return View
     */
    public function index(
        SummaryGetAllRequest $request,
        SummaryRepository $summaryRepository,
        PositionRepository $positionRepository,
        LevelRepository $levelRepository,
        SummaryStatusRepository $summaryStatusRepository
    ): View
    {
        $query = $request->query();
        $filters = $query;

        if( isset( $query[ "name" ] ) ){
            preg_match_all( "/[а-яА-Яa-zA-Z0-9']+/u", $filters[ "name" ], $matches );
            $filters[ "name" ] = $matches[0];
        }

        $summaries = $summaryRepository->getForDashboard( $filters );
        $positions = $positionRepository->getAll();
        $levels = $levelRepository->getAll();
        $statuses = $summaryStatusRepository->getAll();

        return view(
            "index",
            [
                "query" => $query,
                "summaries" => $summaries,
                "positions" => $positions,
                "levels" => $levels,
                "statuses" => $statuses
            ]
        );
    }

    public function view(Request $request, SummaryRepository $summaryRepository){
        return view('view', $summaryRepository->getForView($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Summary $summary
     *
     * @return RedirectResponse
     */
    public function destroy( Summary $summary ): RedirectResponse
    {
        $summary->delete();

        return redirect( "/" );
    }
}
