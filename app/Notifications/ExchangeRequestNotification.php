<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ExchangeRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Permintaan Penukaran Sampah Baru',
            'message' => "User {$this->data['user']} ingin menukar {$this->data['weight']} kg {$this->data['waste']} (poin: {$this->data['points']}) ke bank sampah Anda.",
            'data' => $this->data
        ];
    }
}
