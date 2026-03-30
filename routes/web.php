<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function (Request $request) {
//    $response = Http::withToken(config('services.openai.secret'))->post('https://api.openai.com/v1/responses',[
//      "model"  => "gpt-5",
//         "input" => [
//             [
//                 "role" => "user",
//                 "content" => [
//                     [
//                         "type" => "input_text",
//                         "text" => $request->message
//                     ],
//                 ]
//             ]
//         ]
//    ])->json('choices.0.message.content');
// });



Route::get('/unittest',function(){
    return response()->json('hi',222);
});


