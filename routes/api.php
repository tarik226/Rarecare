<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DescribeController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\MaladieController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PDFController;
use Illuminate\Auth\Access\Events\GateEvaluated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Nette\Utils\Json;
use OpenAI\Laravel\Facades\OpenAI;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//   GET|HEAD        api/patients .................................. patients.index › PatientController@index
//   POST            api/patients .................................. patients.store › PatientController@store  
//   GET|HEAD        api/patients/{patient} .......................... patients.show › PatientController@show  
//   PUT|PATCH       api/patients/{patient} ...................... patients.update › PatientController@update  
//   DELETE          api/patients/{patient} .................... patients.destroy › PatientController@destroy  
//   GET|HEAD        api/user 

Route::group(['middleware' => ['checkPermission:']], function () {
        Route::apiResource('patients', PatientController::class);
        Route::apiResource('maladies', MaladieController::class)->parameters(['maladies' => 'maladie']);
    });

Route::get('/patientttts',[PatientController::class,'index'])->middleware('checkPermission:view patients'); 



// Route::post('/chat', [DescribeController::class, 'describe']);

Route::get('/resume/{patient}', [DescribeController::class, 'generateResume']);

Route::get('/downloadpdf',[PDFController::class,'generatePDF']);


// Route::middleware(['throttle:60,1'])->group(function () {

    
//     Route::prefix('patients')->group(function () {
//         Route::get('/', [GatewayController::class, 'forwardToPatientService']);
//         Route::get('{id}', [GatewayController::class, 'forwardToPatientService']);
//         Route::post('/', [GatewayController::class, 'forwardToPatientService']);
//         Route::put('/{id}', [GatewayController::class, 'forwardToPatientService']);
//         Route::delete('/{id}', [GatewayController::class, 'forwardToPatientService']);
//     });

    
//     Route::prefix('maladies')->group(function () {
//         Route::get('/', [GatewayController::class, 'forwardToMaladieService']);
//         Route::get('{id}', [GatewayController::class, 'forwardToMaladieService']);
//         Route::post('/', [GatewayController::class, 'forwardToMaladieService']);
//         Route::put('/{id}', [GatewayController::class, 'forwardToMaladieService']);
//         Route::delete('/{id}', [GatewayController::class, 'forwardToMaladieService']);
//     });

    
//     Route::get('patients/{id}/maladies', [GatewayController::class, 'aggregatePatientMaladie']);
// });

Route::post('/', function (Request $request) {
    $value = $request->cookie('cookie_name');
    dd($value);
    $historique = session('historique', []);
    $historique[] = [
        'role' => 'user',
        'content' => $request->input('message'),
    ];
    $response = OpenAI::chat()->create([
        'model' => 'openai/gpt-oss-20b', 
        'messages' => $historique,
        'max_tokens' => 2000,
    ]);
    $assistantReply = $response->choices[0]->message->content;
    $historique[] = [
        'role' => 'assistant',
        'content' => $assistantReply,
    ];
    session(['historique' => $historique]);
    return response()->json($assistantReply);
});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('profile', [AuthController::class, 'profile']);
});

 Route::get('profile', [AuthController::class, 'profile']);

Route::group(['middleware' => ['auth:api']], function () {

    Route::group(['middleware' => ['role:scientist']], function () {
        Route::apiResource('maladies', MaladieController::class)->only(['index','show','update']);
    });

    Route::group(['middleware' => ['role:doctor']], function () {
        Route::apiResource('patients', PatientController::class)->only(['show']);
    });
});

