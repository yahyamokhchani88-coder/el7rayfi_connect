<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewJobAvailable extends Notification
{
    use Queueable;

    // 1. ضروري تـعـرّف هاد المتغير هنا
    public $job;

    /**
     * Create a new notification instance.
     */
    public function __construct($job)
    {
        // 2. هنا كنربطو الطلب اللي جاي مع المتغير ديال الكلاس
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'message' => 'همزة جديدة! كاين طلب ديال ' . $this->job->service->name . ' فـ مدينتك.',
            'url' => route('dashboard'),
            'job_id' => $this->job->id,
            'type' => 'job'
        ];
    }
}