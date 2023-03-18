<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'beds', 'baths', 'area', 'address', 'city', 'zip', 'state', 'price', 'comments', 'status_id', 'posted_by'
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
