<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
//this is the correct way to do it
// Broadcast::channel('Messenger.{id}', function ($user, $id) {
//     if ((int) $user->id === (int) $id) {
//         return ['id' => $user->id, 'name' => $user->name]; // or add email, avatar, etc.
//     }
//     return null;
// });
Broadcast::channel('Messenger.{id}', function ($user, $id) {
    if ((int) $user->id === (int) $id) {
        return [
            'id' => $user->id,
            'name' => $user->name, // Optional, add more user fields if needed
            // 'avatar' => $user->avatar, // example
        ];
    }

    return null;
});

// Broadcast::channel('Messenger.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
// Broadcast::channel('Messenger.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id ? ['id' => $user->id, 'name' => $user->name] : null;
// });
