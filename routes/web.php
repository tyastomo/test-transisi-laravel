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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'CompanyController@index')->name('home')->middleware('auth');
Route::post('/submitCompany', 'CompanyController@store')->name('company.submit')->middleware('auth');
Route::delete('/deleteCompany/{id}', 'CompanyController@destroy')->middleware('auth');
Route::post('/updateCompany/{id}', 'CompanyController@update')->middleware('auth');

Route::get('/employees', 'EmployeeController@index')->name('employee')->middleware('auth');
Route::post('/employeeSubmit', 'EmployeeController@store')->name('employee.submit')->middleware('auth');
Route::delete('/deleteEmployee/{id}', 'EmployeeController@destroy')->middleware('auth');
Route::post('/updateEmployee/{id}', 'EmployeeController@update')->middleware('auth');
