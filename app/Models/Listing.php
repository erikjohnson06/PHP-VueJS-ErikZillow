<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model {

    use HasFactory;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'beds', 'baths', 'area', 'address', 'city', 'zip', 'state', 'price', 'comments', 'status_id', 'posted_by'
    ];

    /**
     * @var array
     */
    protected $sortable = [
        'created_at', 'updated_at', 'price', 'beds', 'baths', 'area'
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
     * Map a listing's images
     *
     * @return HasMany
     */
    public function offers(): HasMany {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    /**
     * Map a listing's images
     *
     * @return HasMany
     */
    public function images(): HasMany {
        return $this->hasMany(ListingImage::class);
    }

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeNotSold(Builder $query): Builder {

        //Example of relying on the offers table to look for listing with no accepted/rejected offers
        //return $query->doesntHave('offers')
        //        ->orWhereHas('offers',
        //            fn(Builder $query) => $query->whereNull('accepted_at')->whereNull('rejected_at')
        //);

        return $query->whereNull('sold_at');
    }

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder {

        return $query
                ->when(
                    $filters['priceFrom'] ?? false,
                    fn($query, $value) => $query->where('price', '>=', (float) preg_replace("/,/", "", $value))
                )
                ->when(
                    $filters['priceTo'] ?? false,
                    fn($query, $value) => $query->where('price', '<=', (float) preg_replace("/,/", "", $value))
                )
                ->when(
                    $filters['beds'] ?? false,
                    fn($query, $value) => $query->where('beds', ((int) $value < 6 ? '=' : '>='), (int) $value)
                )
                ->when(
                    $filters['baths'] ?? false,
                    fn($query, $value) => $query->where('baths', ((int) $value < 6 ? '=' : '>='), (int) $value)
                )
                ->when(
                    $filters['areaFrom'] ?? false,
                    fn($query, $value) => $query->where('area', '>=', (float) preg_replace("/,/", "", $value))
                )
                ->when(
                    $filters['areaTo'] ?? false,
                    fn($query, $value) => $query->where('area', '<=', (float) preg_replace("/,/", "", $value))
                )
                ->when(
                    $filters['deleted'] ?? false,
                    fn($query, $value) => $query->withTrashed()
                )
                ->when(
                    $filters['by'] ?? false,
                    fn($query, $value) =>
                    //Ensure that sorted by column is valid
                    !in_array($value, $this->sortable) ?
                    $query :
                    $query->orderBy($value, ($filters['order'] ?? "DESC"))
        );
    }
}
