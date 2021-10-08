<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * @return BelongsTo
     */
    public function position(): BelongsTo{
        return $this->belongsTo( Position::class );
    }

    /**
     * @return BelongsTo
     */
    public function level(): BelongsTo{
        return $this->belongsTo( Level::class );
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo{
        return $this->belongsTo( SummaryStatus::class );
    }
}
