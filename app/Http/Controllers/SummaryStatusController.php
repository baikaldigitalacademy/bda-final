<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\AdminSummaryStatusDeleteRequest;
use App\Http\Requests\AdminSummaryStatusRequest;
use App\Models\SummaryStatus;
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

    public function create( AdminSummaryStatusRequest $request ){
        $summaryStatus = new SummaryStatus();
        $summaryStatus->fill(["name" => $request->get("name")])
            ->save();
    }

    public function update( AdminSummaryStatusRequest $request, SummaryStatus $summaryStatus){
        $summaryStatus
            ->fill(["name" => $request->get("name")])
            ->save();
    }

    public function delete( AdminSummaryStatusDeleteRequest $request, SummaryStatus $summaryStatus ){
        $summaryStatus->delete();
    }
}
