<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{

    // public function chatbot(Request $request)
    // {
    //     $response = Http::withHeaders([
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . env('OPENAI_API_KEY')
    //     ])->post('https://api.openai.com/v1/engines/text-davinci-002/completions', [
    //         'prompt' => $request->input('prompt'),
    //         'temperature' => $request->input('temperature'),
    //         'max_tokens' => $request->input('max_tokens'),
    //         'n' => $request->input('n'),
    //         'stop' => $request->input('stop')
    //     ]);
    
    //     return response()->json($response->json());
    // }

    public function chatbot(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY')
        ])->post('https://api.openai.com/v1/engines/davinci/completions', [
            'prompt' => $request->input('prompt'),
            'temperature' => $request->input('temperature'),
            'max_tokens' => $request->input('max_tokens'),
            'n' => $request->input('n'),
            'stop' => $request->input('stop'),
        ]);

        return response()->json($response->json());
    }

}
