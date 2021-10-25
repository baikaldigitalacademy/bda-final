<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Http\Requests\SummaryGetAllRequest;
use App\Http\Requests\SummaryUpdateRequest;
use App\Http\Requests\SummaryUpdateStatusRequest;
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
     */
    public function destroy( Summary $summary )
    {
        $summary->delete();
    }

    public function edit(Request $request,
                         SummaryRepository $summaryRepository,
                         PositionRepository $positionRepository,
                         LevelRepository $levelRepository,
                         SummaryStatusRepository $summaryStatusRepository)
    {
        $summaryData = $summaryRepository->getForView($request);
        $positions = $positionRepository->getAll();
        $levels = $levelRepository->getAll();
        $statuses = $summaryStatusRepository->getAll();
        return view('edit', array_merge(
            $summaryData,
            [
                "title" => "Редактирование резюме",
                "positions" => $positions,
                "levels" => $levels,
                "statuses" => $statuses,
                "isNew" => False
            ]
        ));
    }

    public function create(
        PositionRepository $positionRepository,
        LevelRepository $levelRepository,
        SummaryStatusRepository $summaryStatusRepository
        )
    {
        return view('edit',
            [
                "title" => "Новое резюме",
                "data" => (object) array (
                    "id" => -1,
                    "name" => "",
                    "date" => "",
                    "email" => "",
                    "status" => "",
                    "level" => "",
                    "position" => "",
                    "skills" => "",
                    "description" => "",
                    "experience" => ""
                ),
                "positions" => $positionRepository->getAll(),
                "levels" => $levelRepository->getAll(),
                "statuses" => $summaryStatusRepository->getAll(),
                "isNew" => True
            ]);
    }

    // TODO remove id, add model
    public function update( SummaryUpdateRequest $request, SummaryRepository $summaryRepository, int $id )
    {
        $summaryRepository->edit( $id, $request->all() );

        return redirect( route( "summaries_one", [ "id" => $id ] ) );
    }

    // TODO with repository
    /**
     * Update summary status.
     *
     * @param SummaryUpdateStatusRequest $request
     * @param Summary $summary
     *
     * @return array
     */
    public function updateStatus( SummaryUpdateStatusRequest $request, Summary $summary ): array
    {
        $summary->update( $request->all() );

        return [ "payload" => $summary->status->color ];
    }

    public function store(SummaryUpdateRequest $request, SummaryRepository $summaryRepository){
        $ownerId = \Auth::user()->id;
        $id = $summaryRepository->store( array_merge( $request->all(), [ "owner_id" => $ownerId ] ) );

        return redirect( route( "summaries_one", [ "id" => $id ] ) );
    }

    public function pdf(SummaryRepository $summaryRepository, Request $request){
        $summary = $summaryRepository->getForView( $request );
        $pdf = \PDF::loadView( "pdf", [ "summary" => $summary[ "data" ] ] );
        $fileName = "summary.pdf";

        return $pdf->inline( $fileName );
    }
}
