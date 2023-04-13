<?php

use App\Http\Controllers\Backend\Course\CourseController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth',
    'prefix'     => '',
    'as'         => ''
], function () {

    Route::resource('courses', CourseController::class);

});
