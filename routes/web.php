<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment;

//Admin
Route::get('/admin', [AppointmentController::class, 'admin_index']);
Route::get('/admin/{appointment}/edit', [AppointmentController::class, 'admin_edit']);
Route::patch('/appointments/{appointment}', [AppointmentController::class, 'admin_update']);
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'admin_delete']);

//Mechanic
Route::get('/mechanic', [AppointmentController::class, 'mechanic_index']);

//User
Route::get('/', [AppointmentController::class, 'user_create']);
Route::get('/index', [AppointmentController::class, 'user_index']);
Route::post('/appointments', [AppointmentController::class, 'user_store']);
Route::get('/user/{appointment}/edit', [AppointmentController::class, 'user_edit']);
Route::patch('/appointments/{appointment}', [AppointmentController::class, 'user_update']);
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'user_delete']);

//Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/mechanic-availability', [AppointmentController::class, 'getMechanicAvailability']);
