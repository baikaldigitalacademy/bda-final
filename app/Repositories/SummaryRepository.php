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

        $builder->join( "positions", "summaries.position_id", "=", "positions.id" );
        $builder->join( "levels", "summaries.level_id", "=", "levels.id", "left" );
        $builder->join( "summary_statuses", "summaries.status_id", "=", "summary_statuses.id" );

        $builder->select( [
            "summaries.id", "summaries.name",
            "email", "position_id",
            "level_id", "date", "status_id",
            "positions.name as position_name",
            "levels.name as level_name",
            "summary_statuses.name as status_name"
        ] );

        if( isset( $filters[ "name" ] ) ){
            $name = implode( "|", $filters[ "name" ] );

            $builder->where( "summaries.name", "regexp", $name );
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

        if( isset( $filters[ "order_column" ] ) ){
            $orderColumn = "{$filters[ "order_column" ]}";
        } else {
            $orderColumn = "id";
        }

        if( isset( $filters[ "order_direction" ] ) ){
            $orderDirection = $filters[ "order_direction" ];
        } else {
            $orderDirection = "asc";
        }

        if( in_array( $orderColumn, [ "positions", "levels", "summary_statuses" ] ) ){
            $orderColumn = "$orderColumn.name";
        }

        return $builder
            ->orderByRaw( "$orderColumn $orderDirection" )
            ->get();
    }

    public function getForView($request){
        $data = (DB::table('summaries')
            ->leftJoin('levels', 'levels.id', '=', 'summaries.level_id')
            ->leftJoin('summary_statuses', 'summary_statuses.id', '=', 'summaries.status_id')
            ->leftJoin('positions', 'positions.id', '=', 'summaries.position_id')
            ->select(
                "summaries.name as name",
                "summaries.date as date",
                "summaries.email as email",
                "summary_statuses.name as status",
                "levels.name as level",
                "positions.name as position",
                "summaries.skills as skills",
                "summaries.description as description",
                "summaries.experience as experience",
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

    public function store( array $fields ){
        $summary = new Summary();

        $summary->fill( $fields );
        $summary->save();
        return $summary->id;
    }
}
