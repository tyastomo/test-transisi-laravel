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

Route::get('/home', 'CompanyController@index')->name('home');
Route::post('/submitCompany', 'CompanyController@store')->name('company.submit');
Route::delete('/deleteCompany/{id}', 'CompanyController@destroy');
Route::post('/updateCompany/{id}', 'CompanyController@update');

Route::get('/employees', 'EmployeeController@index')->name('employee');
Route::post('/employeeSubmit', 'EmployeeController@store')->name('employee.submit');
Route::delete('/deleteEmployee/{id}', 'EmployeeController@destroy');
Route::post('/updateEmployee/{id}', 'EmployeeController@update');
