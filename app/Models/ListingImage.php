<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model {

    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'filename'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'src'
    ];

    /**
     * Map the listing_id field to a listing
     *
     * @return BelongsTo
     */
    public function listing(): BelongsTo {
        return $this->belongsTo(Listing::class);
    }

    /**
     * @return string
     */
    public function getSrcAttribute() : string {
        return asset("storage/{$this->filename}");
    }
}
