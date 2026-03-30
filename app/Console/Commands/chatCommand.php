<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;


class chatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public static function describePatient($patient)
    {
        //
        $prism=self::prism();
        $answer = $prism->withPrompt("decrivez le dossier de patient {$patient}")->asText();
        return $answer;

    }

    protected static function prism(){
        return Prism::text()->using(Provider::OpenRouter , 'google/gemini-2.5-flash');
    }
}
