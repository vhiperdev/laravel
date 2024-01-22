<?php

namespace App\Traits;

use App\Models\Customers;
use App\Models\MessageTemplate;
use App\Models\ResellerPlanSubscription;
use App\Models\Settings;
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
        $subscription = Subscription::where('customer_id', $customer->id)->with('productplan')->orderBy('id', 'desc')->first();

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
            '{PLAN_VALUE}'   => $subscription->productplan->plan->value?? 'NO SUBSCRIPTION YET',
            '{PLAN_NAME}' => $subscription->productplan->plan->name?? 'NO SUBSCRIPTION YET',
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }


    public function replacePlaceholdersBulk($customer, $msgId)
    {

        // Define an associative array with key-value pairs for replacement 
        $subscription = Subscription::where('customer_id', $customer->id)->with('productplan')->orderBy('id', 'desc')->first();

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
            '{PLAN_VALUE}'   => $subscription->productplan->plan->value?? 'NO SUBSCRIPTION YET',
            '{PLAN_NAME}' => $subscription->productplan->plan->name?? 'NO SUBSCRIPTION YET',
        ];

        $text = $this->getMessage($msgId)->content;

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }




    /**
     * Replace placeholders in a text with actual values.
     *
     * @param string $text
     * @param array $replacements
     * @return string
     */
    public function resellerReplacePlaceholders($customer, $text)
    {
        //get settings
        $settings = Settings::first();

        // Define an associative array with key-value pairs for replacement 
        $subscription = ResellerPlanSubscription::where('reseller_id', $customer->id)->with('resellerPlan')->orderBy('id', 'desc')->first();

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
            '{PLAN_VALUE}'   => $subscription->resellerPlan->value,
            '{PLAN_NAME}' => $subscription->resellerPlan->name,
            '{CURRENCY}' => $settings->currencyDetails->symbol
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }


    public function resellerReplacePlaceholdersBulk($customer, $msgId)
    {
        //get settings
        $settings = Settings::first();
        // Define an associative array with key-value pairs for replacement 
        $subscription = ResellerPlanSubscription::where('reseller_id', $customer->id)->with('resellerPlan')->orderBy('id', 'desc')->first();

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
            '{PLAN_VALUE}'   => $subscription->resellerPlan->value,
            '{PLAN_NAME}' => $subscription->resellerPlan->name,
            '{CURRENCY}' => $settings->currencyDetails->symbol
        ];

        $text = $this->getMessage($msgId)->content;

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }

    protected function getMessage($msgId)
    {
        return MessageTemplate::findOrFail($msgId);
    }
}
