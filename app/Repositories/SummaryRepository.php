<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Summary;

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
            "summaries.id", "order", "summaries.name", "surname",
            "middle_name", "email", "position_id",
            "level_id", "date", "status_id",
            "positions.name as position_name",
            "levels.name as level_name",
            "summary_statuses.name as status_name"
        ] );

        if( isset( $filters[ "name" ] ) ){
            $name = implode( "|", $filters[ "name" ] );

            $builder->where( function( $query ) use ( $name ){
                $query->orWhere( "summaries.name", "regexp", $name );
                $query->orWhere( "surname", "regexp", $name );
                $query->orWhere( "middle_name", "regexp", $name );
            } );
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
            $orderColumn = "order";
        }

        if( $orderColumn === "order" ){
            $orderColumn = "`$orderColumn`";
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
}
