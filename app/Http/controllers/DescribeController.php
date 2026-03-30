<?php

namespace App\Http\Controllers;

use App\Console\Commands\chatCommand;
use App\Models\Patient;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class DescribeController extends Controller
{
    //

    public function describe(Request $request)
    {
        $patient = $request->input('patient');
        $answer = chatCommand::describePatient($patient);

        return response()->json([
            'patient' => $patient,
            'description' => $answer,
        ]);
    }

    public function generateResume(Patient $patient)
    {
        $response = OpenAI::chat()->create([
            'model' => 'openai/gpt-oss-20b',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Fais un résumé médical clair avec ces données (text sans symbole): " . json_encode($patient)
                ]
            ],
            'max_tokens' => 2000
        ]);
        $resume = $response->choices[0]->message->content;
        return response()->json($resume);
    }
}
