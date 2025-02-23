<?php

namespace App;

trait WithNotification
{
    public function notify($message, $type = 'success')
    {
        $this->dispatch('notify', message: $message, type: $type);
    }

    public function notifySuccess($message)
    {
        $this->notify($message, 'success');
    }

    public function notifyError($message)
    {
        $this->notify($message, 'error');
    }

    public function notifyInfo($message)
    {
        $this->notify($message, 'info');
    }

    public function notifyWarning($message)
    {
        $this->notify($message, 'warning');
    }
}
