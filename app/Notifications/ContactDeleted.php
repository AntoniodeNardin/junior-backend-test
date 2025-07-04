<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ContactDeleted extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Seu contato foi removido')
            ->greeting('Olá, ' . $notifiable->name)
            ->line('Seu contato foi excluído do sistema.')
            ->salutation('Atenciosamente, Equipe.');
    }
}
