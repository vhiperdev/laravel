<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SendMessages
{
    public function send(string $number, string $message, $sender_id)
    {
        $client = new Client();

        try {
            $response = $client->post(env('WHATSAPP_API_URI', 'http://178.128.115.23/whatsapp-app/send-message'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'number' => $number,
                    'message' => $message,
                    'userId' => $sender_id
                ],
            ]);

            // Handle the response if needed
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            return request()->json($body, $statusCode);
            // Do something with $statusCode and $body
        } catch (\Exception $e) {
            // Handle the exception 
            Log::warning('Send Message Error: ' . $e->getMessage());
        }
    }
}
