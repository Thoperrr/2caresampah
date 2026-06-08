<?php
Route::post('/pickup-requests', [PickupController::class, 'store']);
Route::get('/pickup-requests/active', [PickupController::class, 'activeRequests']);
Route::post('/assign-collector/{request}', [PickupController::class, 'assignCollector']);