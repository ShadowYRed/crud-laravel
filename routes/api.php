<?php

use App\Http\Controllers\Api\RandomUserController;

Route::get('/random-user-analysis', [RandomUserController::class, 'fetchAndAnalyzeNames']);
