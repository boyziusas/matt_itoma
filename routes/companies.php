<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Companies Routes
|--------------------------------------------------------------------------
*/
Route::resource('/companies', \App\Http\Controllers\CompanyController::class,
    ['names' =>
        ['index' => 'companies']
    ]
);
Route::get('/companies-paginated','\App\Http\Controllers\CompanyController@indexPaginated')->name('companies.paginated');
