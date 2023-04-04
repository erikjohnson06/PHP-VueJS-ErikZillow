<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail {

    use HasApiTokens,
        HasFactory,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Hash a user's password
     *
     * @return Attribute
     */
    protected function password(): Attribute {
        return Attribute::make(
                get: fn(string $value) => $value,
                set: fn(string $value) => Hash::make($value)
        );
    }

    /**
     * Map a user's listings
     *
     * @return HasMany
     */
    public function listings(): HasMany {
        return $this->hasMany(Listing::class, 'posted_by');
    }

    /**
     * Map a user's offers
     *
     * @return HasMany
     */
    public function offers(): HasMany {
        return $this->hasMany(Offer::class, 'bidder_id');
    }
}
