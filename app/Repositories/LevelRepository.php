<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Level;

class LevelRepository
{
    public function getAll(): Collection{
        return Level::all();
    }
}
