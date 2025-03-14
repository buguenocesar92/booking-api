<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserPrivateNotification implements ShouldBroadcast
{
    public $message;
    public $userId;

    public function __construct($message, $userId)
    {
        $this->message = $message;
        $this->userId = $userId;
    }

    // Define el canal privado dinámico
    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->userId); // Ej: "user.5"
    }

    // Opcional: Personaliza el nombre del evento para el frontend
    public function broadcastAs()
    {
        return 'new.private.message';
    }
}
