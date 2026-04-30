<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CampaignController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/', [ContactController::class, 'index']);
Route::post('/upload', [ContactController::class, 'upload']);
Route::get('/contact/delete/{id}', [ContactController::class, 'delete']);
Route::get('/contact/edit/{id}', [ContactController::class, 'edit']);
Route::post('/contact/update/{id}', [ContactController::class, 'update']);
Route::get('/contacts/download-csv-format', [ContactController::class, 'downloadCsvFormat']);

Route::get('/templates', [TemplateController::class, 'index']);
Route::post('/save-template', [TemplateController::class, 'store']);
Route::get('/template/edit/{id}', [TemplateController::class, 'edit']);
Route::post('/template/update/{id}', [TemplateController::class, 'update']);

Route::get('/campaigns', [CampaignController::class, 'index']);
Route::post('/create-campaign', [CampaignController::class, 'create']);

Route::get('/send-campaign/{id}', [CampaignController::class, 'send']);

Route::get('/logs', [CampaignController::class, 'logs']);

// Route::get('/test-mail', function () {

//     dispatch(new \App\Jobs\SendEmailJob([
//         'email' => 'jitendrapal0751@gmail.com',
//         'message' => 'Hello test'
//     ]));

//     return "Sent";
// });