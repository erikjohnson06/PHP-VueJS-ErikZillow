<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

//use Illuminate\Auth\Access\Response;

class ListingPolicy {

    public function before(?User $user, string $ability = ""){

        if ($user->is_admin){

            //Create exceptions based on ability requested
            //if ($ability === "update"){return false}

            return true;
        }
    }

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
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param Listing $listing
     * @return bool
     */
    public function view(?User $user, Listing $listing): bool {
        return true;
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
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function update(User $user, Listing $listing): bool {
        return ($user->id === $listing->posted_by);
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
