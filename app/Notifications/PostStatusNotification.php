<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostStatusNotification extends Notification
{
    use Queueable;

    public $post;
    public $status;
    /**
     * Create a new notification instance.
     */
    public function __construct($post, $status)
    {
        $this->post = $post;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusMessage = $this->status === 'approved' ? 'Approved' : 'Rejected';
        return (new MailMessage)
            ->subject("Your Post Has Been {$statusMessage}")
            ->greeting("Hello " . $notifiable->name)
            ->line("Your post titled '{$this->post->title}' has been {$statusMessage}.")
            ->action('View Post', url('/posts/' . $this->post->id))
            ->line('Thank you for using our content platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
