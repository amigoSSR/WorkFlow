<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MilestoneStatusUpdated extends Notification
{
    use Queueable;

    public $milestone;
    public $performer;
    public $oldStatus;
    public $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct($milestone, $performer, $oldStatus, $newStatus)
    {
        $this->milestone = $milestone;
        $this->performer = $performer;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
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
            'milestone_id' => $this->milestone->id,
            'milestone_title' => $this->milestone->title,
            'project_id' => $this->milestone->project_id,
            'project_name' => $this->milestone->project->name,
            'performer_name' => $this->performer->name,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'message' => $this->performer->name . ' mengubah status milestone "' . $this->milestone->title . '" menjadi ' . $this->newStatus,
        ];
    }
}
