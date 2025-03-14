<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return ['chat']; // 📌 Este es el canal donde Redis debería recibir eventos
    }

    public function broadcastAs()
    {
        return 'new-message'; // 📌 Nombre del evento en el frontend
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
        ];
    }
}
