<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "date",
        "skills",
        "description",
        "experience",
        "position_id",
        "level_id",
        "status_id"
    ];
}
