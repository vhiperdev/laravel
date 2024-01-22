<?php

namespace App\Http\Controllers;

use App\Services\BillingMessengerService;
use GuzzleHttp\Client;
use SevenSpan\WhatsApp\Facades\WhatsApp;

class NotificationController extends Controller
{
    public function index()
    {

        $billMessenger = new BillingMessengerService();
        $billMessenger->index();
    }

    public function test()
    {
        $client = new Client();

        try {
            $response = $client->post('http://localhost:3000/sendmessage', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'number' => '+2348143233341',
                    'message' => 'How are you bro?',
                ],
            ]);

            // Handle the response if needed
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            return request()->json($body, $statusCode);
            // Do something with $statusCode and $body
        } catch (\Exception $e) {
            // Handle the exception
            echo 'Error: ' . $e->getMessage();
        }
    }
}
