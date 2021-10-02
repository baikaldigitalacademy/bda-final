<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Summary;
use Illuminate\Support\Facades\DB;

class SummaryRepository
{
    /**
     * @param array $filters
     *
     * @return Collection
     */
    public function getForDashboard( array $filters = [] ): Collection{
        $builder = Summary::query();

        if( isset( $filters[ "name" ] ) ){
            $name = implode( "|", $filters[ "name" ] );

            $builder->where( "name", "regexp", $name );
        }

        if( isset( $filters[ "email" ] ) ){
            $builder->where( "email", "like", "%" . $filters[ "email" ] . "%" );
        }

        if( isset( $filters[ "position_id" ] ) ){
            $builder->where( "position_id", "=", $filters[ "position_id" ] );
        }

        if( isset( $filters[ "level_id" ] ) ){
            $builder->where( "level_id", "=", $filters[ "level_id" ] );
        }

        if( array_key_exists( "without_level", $filters ) ){
            $builder->where( "level_id", "=", null );
        }

        if( isset( $filters[ "date_start" ] ) ){
            $builder->where( "date", ">=", $filters[ "date_start" ] );
        }

        if( isset( $filters[ "date_end" ] ) ){
            $builder->where( "date", "<=", $filters[ "date_end" ] );
        }

        if( isset( $filters[ "status_id" ] ) ){
            $builder->where( "status_id", "=", $filters[ "status_id" ] );
        }

        $orderColumn = $filters[ "order_column" ] ?? "id";
        $orderDirection = $filters[ "order_direction" ] ?? "asc";

        return $builder
            ->with( [ "position:id,name", "level:id,name", "status:id,name,color" ] )
            ->orderBy( $orderColumn, $orderDirection )
            ->get( [
                "id", "name",  "email", "position_id",
                "level_id", "date", "status_id"
            ] );
    }

    public function getForView($request){
        $data = (DB::table('summaries')
            ->leftJoin('levels', 'levels.id', '=', 'summaries.level_id')
            ->leftJoin('summary_statuses', 'summary_statuses.id', '=', 'summaries.status_id')
            ->leftJoin('positions', 'positions.id', '=', 'summaries.position_id')
            ->select(
                "summaries.name as Full_name",
                "summaries.date as Date",
                "summaries.email as Email",
                "summary_statuses.name as Status",
                "levels.name as Level",
                "positions.name as Position",
                "summaries.skills as Skills",
                "summaries.description as Description",
                "summaries.experience as Experience",
            )
            ->where('summaries.id', '=', $request->id)
            ->get())[0];
        return [
            'data' => $data,
            'id' => $request->id
        ];
    }

    /**
     * @param int $id
     * @param array $fields
     */
    public function edit( int $id, array $fields ){
        $summary = Summary::find( $id );

        $summary->fill( $fields );
        $summary->save();
    }
}
