<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $messages = [];
    protected $listeners = ['notify'];

    public function notify($message, $type = 'success')
    {
        $this->messages[] = [
            'message' => $message,
            'type' => $type,
            'id' => uniqid()
        ];
    }

    public function remove($messageId)
    {
        $this->messages = array_filter($this->messages, function($message) use ($messageId) {
            return $message['id'] !== $messageId;
        });
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
