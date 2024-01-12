<?php

namespace App\Traits;

use App\Models\Customers;
use App\Models\MessageTemplate;
use App\Models\Subscription;

trait TextReplacementTrait
{
    /**
     * Replace placeholders in a text with actual values.
     *
     * @param string $text
     * @param array $replacements
     * @return string
     */
    public function replacePlaceholders($customer, $text)
    {

        // Define an associative array with key-value pairs for replacement 
        $subscription = Subscription::where('customer_id', $customer->id)->orderBy('id', 'desc')->first();

        $replacements = [
            '{NAME}' => $customer->name,
            '{EXPIRY_DATE}' => $subscription->next_due_date ?? null,
            '{PROVIDER}' => $customer->get_server->name ?? 'NO SERVER',
            '{DEVICE}' => $customer->get_device->name ?? 'NO DEVICE',
            '{APPLICATION}' => $customer->get_application->name ?? 'NO APPLICATION',
            '{SCREEN}' => $customer->screen,
            '{KEY}' => $customer->key,
            '{MAC}' => $customer->mac,
            '{USERNAME}' => $customer->username,
            '{WHATSAPP_NUMBER}' => $customer->whatsapp,
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }


    public function replacePlaceholdersBulk($customer, $msgId)
    {

        // Define an associative array with key-value pairs for replacement 
        $subscription = Subscription::where('customer_id', $customer->id)->orderBy('id', 'desc')->first();

        $replacements = [
            '{NAME}' => $customer->name,
            '{EXPIRY_DATE}' => $subscription->next_due_date ?? null,
            '{PROVIDER}' => $customer->get_server->name ?? 'NO SERVER',
            '{DEVICE}' => $customer->get_device->name ?? 'NO DEVICE',
            '{APPLICATION}' => $customer->get_application->name ?? 'NO APPLICATION',
            '{SCREEN}' => $customer->screen,
            '{KEY}' => $customer->key,
            '{MAC}' => $customer->mac,
            '{USERNAME}' => $customer->username,
            '{WHATSAPP_NUMBER}' => $customer->whatsapp,
        ];

        $text = $this->getMessage($msgId)->content;

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }

    protected function getMessage($msgId)
    {
        return MessageTemplate::findOrFail($msgId);
    }
}
