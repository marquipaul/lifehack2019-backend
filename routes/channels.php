<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('application.{appointmentId}', function ($user, $appointmentId) {
//     return $user->id === Appointment::findOrNew($appointmentId)->user_id;
// });

Broadcast::channel('Chat.{receiver_id}', function ($user, $user_id, $receiver_id) {
    return $user->id ==  $receiver_id;
});