<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy {

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param DatabaseNotification $databaseNotification
     * @return bool
     */
    public function view(User $user, DatabaseNotification $databaseNotification): bool {
        return $user->id === $databaseNotification->notifiable_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param DatabaseNotification $databaseNotification
     * @return bool
     */
    public function update(User $user, DatabaseNotification $databaseNotification): bool {
        return $user->id === $databaseNotification->notifiable_id;
    }
}
