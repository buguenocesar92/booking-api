<?php

use Illuminate\Support\Facades\Broadcast;

// Autorización para el canal 'user.{userId}'
Broadcast::channel('user.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId; // Solo el usuario con ese ID puede escuchar
});
