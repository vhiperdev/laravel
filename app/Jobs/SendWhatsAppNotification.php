<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\BillingMessengerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsAppNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Implement the logic for sending WhatsApp notifications here
        $billMessenger = new BillingMessengerService();
        $billMessenger->index();
    }
}
