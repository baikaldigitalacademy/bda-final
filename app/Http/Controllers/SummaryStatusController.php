<?php

namespace App\Http\Controllers;

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

        return view( "directories.summary_statuses", [
            "data" => $summaryStatuses
        ] );
    }

    public function create( AdminSummaryStatusRequest $request ){
        $summaryStatus = new SummaryStatus();
        $summaryStatus->fill(["name" => $request->get("name")])
            ->save();

        return $summaryStatus->id;
    }

    public function update( AdminSummaryStatusRequest $request, SummaryStatus $summaryStatus){
        $summaryStatus->update( $request->all() );
    }

    public function delete( AdminSummaryStatusDeleteRequest $request, SummaryStatus $summaryStatus ){
        $summaryStatus->delete();
    }
}
