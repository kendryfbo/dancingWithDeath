<?php

use Illuminate\Http\Request;

Route::get('appointments/date/', 'DeathAppointmentController@availables');
Route::post('appointments', 'DeathAppointmentController@store');
