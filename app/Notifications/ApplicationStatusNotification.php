<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusNotification extends Notification
{
    use Queueable;

    protected $application;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($application, $status)
    {
        $this->application = $application;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $statusLabel = $this->application->statusLabel();
        $jobTitle = $this->application->job->title;
        $companyName = $this->application->job->employer->employerProfile?->company_name ?? $this->application->job->employer->name;

        $message = (new MailMessage)
            ->subject('Update regarding your application for ' . $jobTitle)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('There has been an update to your application for the position of **' . $jobTitle . '** at **' . $companyName . '**.');

        if ($this->status === 'hired') {
            $message->line('Congratulations! You have been **selected** for this position.')
                   ->line('The employer will be in touch with you shortly regarding the next steps.');
        } elseif ($this->status === 'rejected') {
            $message->line('Thank you for your interest in the position. After careful consideration, we have decided to move forward with other candidates at this time.')
                   ->line('We appreciate you taking the time to apply and wish you the best in your job search.');
        } else {
            $message->line('Your application status has been updated to: **' . $statusLabel . '**.');
        }

        return $message
            ->action('View Application Status', route('seeker.applications.index'))
            ->line('Thank you for using CareerLink!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'job_title'      => $this->application->job->title,
            'status'         => $this->status,
            'status_label'   => $this->application->statusLabel(),
            'message'        => 'Your application for ' . $this->application->job->title . ' has been updated to ' . $this->application->statusLabel() . '.',
            'link'           => route('seeker.applications.index'),
        ];
    }
}
