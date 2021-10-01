<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Repositories\SummaryStatusRepository;

class SummaryStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SummaryStatusRepository $summaryStatusRepository
     *
     * @return View
     */
    public function index( SummaryStatusRepository $summaryStatusRepository ): View
    {
        $summaryStatuses = $summaryStatusRepository->getAll();

        return view( "simple_directory", [
            "data" => $summaryStatuses,
            "directoryName" => "Статусы (решения)",
            "baseUrl" => url( "/summary_statuses" )
        ] );
    }
}
