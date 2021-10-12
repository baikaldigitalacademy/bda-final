<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Role;

class RoleRepository
{
    public function getAll(): Collection{
        return Role::all();
    }
}
