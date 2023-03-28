<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id','bidder_id','amount','accepted_at','rejected_at'
    ];

    /**
     * Map the posted_by field to a user id
     *
     * @return BelongsTo
     */
    public function listing(): BelongsTo {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    /**
     * Map the posted_by field to a user id
     *
     * @return BelongsTo
     */
    public function bidder(): BelongsTo {
        return $this->belongsTo(User::class, 'bidder_id');
    }
}