<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\DatabaseNotification;
use Inertia\Response as InertiaResponse;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(Request $request) : InertiaResponse {

        return Inertia::render(
                'Notifications/Index',
                [
                    'notifications' => $request->user()->notifications()->paginate(10)
                ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @return RedirectResponse
     */
    public function update(DatabaseNotification $notification): RedirectResponse {

        //dd($notification);

        $this->authorize('update', $notification);

        //$id = (int) $request->id;
        $notification->markAsRead();

        return redirect()->route('notification.index')->with('success', 'Notifcation marked as read');
    }
}
