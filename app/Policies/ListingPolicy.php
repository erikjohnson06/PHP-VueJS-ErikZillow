<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingPolicy {

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @return bool
     */
    public function viewAny(?User $user): bool {
        return true;
    }

    /**
     * Determine whether the user can view the model. Listing can not be viewed once sold.
     *
     * @param User|null $user
     * @param Listing $listing
     * @return bool
     */
    public function view(?User $user, Listing $listing): bool {

        if ($user && $listing->posted_by === $user->id){
            return true;
        }

        return ($listing->sold_at === null);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool {
        return true;
    }

    /**
     * Determine whether the user can update the model. Listing can not be updated once sold.
     *
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function update(User $user, Listing $listing): bool {
        return ($listing->sold_at === null && $user->id === $listing->posted_by);
    }

    /**
     * Determine whether the user can create an offer on the listing. Offer can not be made once listing is sold.
     *
     * @param User|null $user
     * @param Listing $listing
     * @return bool
     */
    public function offer(?User $user, Listing $listing): bool {

        if (!$user){
            return false;
        }

        return ($listing->sold_at === null);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function delete(User $user, Listing $listing): bool {
        return ($user->id === $listing->posted_by);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function restore(User $user, Listing $listing): bool {
        return ($user->id === $listing->posted_by);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function forceDelete(User $user, Listing $listing): bool {
        return ($user->id === $listing->posted_by);
    }
}
