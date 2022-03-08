<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/
Route::resource('/employees', \App\Http\Controllers\EmployeeController::class,
    ['names' =>
        ['index' => 'employees']
    ]
);
