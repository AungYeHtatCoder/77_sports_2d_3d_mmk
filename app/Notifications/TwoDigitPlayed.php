<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Lottery;
use App\Models\User;
class TwoDigitPlayed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $user;
    protected $lottery;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Lottery $lottery
     */
    public function __construct(User $user, Lottery $lottery)
    {
        $this->user = $user;
        $this->lottery = $lottery;
    }

    


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    return [
        'message' => 'A user has played the two-digit game.',
        'user_id' => $this->user->id,
        'lottery_id' => $this->lottery->id,
    ];
}
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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