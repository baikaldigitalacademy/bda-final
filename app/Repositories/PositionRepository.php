<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Position;

class PositionRepository
{
    public function getAll(): Collection{
        return Position::all();
    }
}
