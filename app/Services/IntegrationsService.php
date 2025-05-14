<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class IntegrationsService
{
    public function analyzeLastOrders(): string
    {
        $orders = Order::latest()->take(3)->get();

        $message = "Given this sales data, which products should we promote for higher revenue?\n\n";
        $message .= $orders->toJson();

        // Send to ChatGPT
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $message]
            ]
        ]);
        if ($response->failed()) {
        Log::error('OpenAI API call failed', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
        return 'API call failed';
        }

        $data = $response->json();
        return $data['choices'][0]['message']['content'] ?? 'No response';
    }

    public function weatherBasedPromotion(): string
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $city = 'london'; // or get from user/location

        $weatherResponse = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");

        if ($weatherResponse->failed()) {
            Log::error('OpenAI API call failed', [
            'status' => $weatherResponse->status(),
            'body' => $weatherResponse->body(),
        ]);
            return 'Unable to fetch weather data.';
        }

        $temp = $weatherResponse['main']['temp'];

        return $temp >= 25
            ? 'It\'s hot today. Promote cold drinks!'
            : 'It\'s cold today. Promote hot drinks!';
    }
}
