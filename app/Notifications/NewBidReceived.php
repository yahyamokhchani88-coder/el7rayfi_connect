<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewBidReceived extends Notification
{
    use Queueable;

    // 1. ضروري تـعـرّف هاد المتغير هنا
    public $bid;

    /**
     * Create a new notification instance.
     */
    public function __construct($bid)
    {
        // 2. ربط العرض لي جاي مع المتغير ديال الكلاس
        $this->bid = $bid;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'message' => 'عرض جديد! حريفي عطاك ثمن ' . $this->bid->price . ' DH على الطلب ديالك.',
            'url' => route('jobs.my-jobs'),
            'bid_id' => $this->bid->id,
            'type' => 'bid'
        ];
    }
}