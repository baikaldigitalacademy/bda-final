<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\SummaryStatus;

class SummaryStatusRepository
{
    public function getAll(): Collection{
        return SummaryStatus::all();
    }
}
