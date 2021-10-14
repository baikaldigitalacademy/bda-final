<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "name",
        "login",
        "password",
        "role_id"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        "password"
    ];

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo{
        return $this->belongsTo( Role::class );
    }

    /**
     * @param array $roles
     *
     * @return bool
     */
    public function hasAnyRole( array $roles ): bool{
        return in_array( $this->role->name, $roles );
    }
}
