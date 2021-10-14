<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getAll(): Collection{
        $user = User::query();

        return $user
            ->with('role:id,name')
            ->get();
    }
}
