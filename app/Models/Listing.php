<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'beds', 'baths', 'area', 'address', 'city', 'zip', 'state', 'price', 'comments', 'status_id', 'posted_by'
    ];

    /**
     * Map the posted_by field to a user id
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, 'posted_by');
    }

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters) : Builder {

        return  $query
            ->when(
                $filters['priceFrom'] ?? false,
                fn ($query, $value) => $query->where('price', '>=', (float) preg_replace("/,/", "", $value))
            )
            ->when(
                $filters['priceTo'] ?? false,
                fn ($query, $value) => $query->where('price', '<=', (float) preg_replace("/,/", "", $value))
            )
            ->when(
                $filters['beds'] ?? false,
                fn ($query, $value) => $query->where('beds',  ((int) $value < 6 ? '=' : '>='), (int) $value)
            )
            ->when(
                $filters['baths'] ?? false,
                fn ($query, $value) => $query->where('baths', ((int) $value < 6 ? '=' : '>='), (int) $value)
            )
            ->when(
                $filters['areaFrom'] ?? false,
                fn ($query, $value) => $query->where('area', '>=', (float) preg_replace("/,/", "", $value))
            )
            ->when(
                $filters['areaTo'] ?? false,
                fn ($query, $value) => $query->where('area', '<=', (float) preg_replace("/,/", "", $value))
            );
    }
}
