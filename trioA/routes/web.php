<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'PagesController@welcome');
Route::get('/dashboard', 'dashboardController@index')->name('dashboard')->middleware('verifiedphone');

Route::get('/edit','UserController@edit');
Route::put('edit','UserController@update');

Auth::routes();

Route::get('phone/verify', 'PhoneVerificationController@show')->name('phoneverification.notice');
Route::post('phone/verify', 'PhoneVerificationController@verify')->name('phoneverification.verify');
Route::post('build-twiml/{code}', 'PhoneVerificationController@buildTwiMl')->name('phoneverification.build'); 


Route::resource('/programs','ProgramsController');//programs table
Route::resource('/projects','ProjectsController');//projects table
Route::get('/{program_id}/projects/create','ProjectsController@create')->name('projects.create');
Route::post('/{program_id}/projects','ProjectsController@store')->name('projects.store');
Route::resource('/sub_projects','SubProjectsController');//sub_projects table
Route::get('/{project_id}/sub_projects/create','SubProjectsController@create')->name('sub_projects.create');
Route::post('/{project_id}/sub_projects','SubProjectsController@store')->name('sub_projects.store');
Route::resource('/activities','ActivitiesController');//activities table
Route::get('/{sub_project_id}/activities/create','ActivitiesController@create')->name('activities.create');
Route::post('/{sub_project_id}/activities','ActivitiesController@store')->name('activities.store');
Route::put('/release/{activity_id}','ActivitiesController@release')->name('activities.release');
Route::resource('/participants','ParticipantsController');//participants table
Route::get('/{activity_id}/participants/create','ParticipantsController@create')->name('participants.create');
Route::post('/{activity_id}/participants','ParticipantsController@store')->name('participants.store');