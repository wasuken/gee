<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', 'JobOfferController@index')->middleware('auth');
Route::get('/job_offer', 'JobOfferController@index')->middleware('auth');
Route::get('/job_offer/create', 'JobOfferController@create')->middleware('auth');
Route::post('/job_offer', 'JobOfferController@store')->middleware('auth');

Route::post('/job_application', 'JobApplicationController@store')->middleware('auth');
Route::get('/job_application', 'JobApplicationController@index')->middleware('auth');
Route::get('/job_application/create', 'JobApplicationController@create')->middleware('auth');
Route::delete('/job_application', 'JobApplicationController@destroy')->middleware('auth');

Route::get('/job_seeker', 'JobSeekerController@index')->middleware('auth');

Route::get('/scout', 'ScoutController@index')->middleware('auth');
