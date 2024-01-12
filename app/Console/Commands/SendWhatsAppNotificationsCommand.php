<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendWhatsAppNotification;

class SendWhatsAppNotificationsCommand extends Command
{
    protected $signature = 'send:whatsapp-notifications';
    protected $description = 'Send WhatsApp notifications to customers';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Dispatch the job to the queue
        dispatch(new SendWhatsAppNotification());

        $this->info('WhatsApp notifications sent successfully.');
    }
}
