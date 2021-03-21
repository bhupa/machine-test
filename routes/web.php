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

Route::get('/', function(){
    if(auth()->check()){
        return redirect()->to('dashboard');
    }
 return redirect()->to('login');
});
Route::get('/register','LoginController@register')->name('register');
Route::post('/add-user','LoginController@addUser')->name('add-user');

Route::get('/login','LoginController@showLogin')->name('login');
Route::post('/login','LoginController@login')->name('login');


Route::group(['middleware'=>'auth'],function () {
Route::get('/dashboard','DashboardController@index')->name('dashboard');
Route::get('/logout','DashboardController@logout')->name('logout');
Route::get('/contact','ContactController@index')->name('contact');
Route::get('/contact/create','ContactController@create')->name('contact.create');
Route::post('/contact/store','ContactController@store')->name('contact.store');
Route::get('/contact/edit/{id}','ContactController@edit')->name('contact.edit');
Route::post('/contact/update/{id}','ContactController@update')->name('contact.update');
Route::post('/contact/destroy','ContactController@destroy')->name('contact.destroy');
Route::post('/contact/change-status','ContactController@changeStatus')->name('contact.change-status');

Route::get('account','AccountController@index')->name('account');
Route::get('account/create','AccountController@create')->name('account.create');
Route::post('account/store','AccountController@store')->name('account.store');
Route::get('account/edit/{id}','AccountController@edit')->name('account.edit');
Route::post('account/update/{id}','AccountController@update')->name('account.update');
Route::post('account/destroy','AccountController@destroy')->name('account.destroy');
Route::post('account/change-status','AccountController@changeStatus')->name('account.change-status');

Route::get('phone/{id}','PhoneController@index')->name('phone');
Route::get('phone/create/{id}','PhoneController@create')->name('phone.create');
Route::post('phone/store','PhoneController@store')->name('phone.store');
Route::get('phone/edit/{id}','PhoneController@edit')->name('phone.edit');
Route::post('phone/update/{id}','PhoneController@update')->name('phone.update');
Route::post('phone/destroy','PhoneController@destroy')->name('phone.destroy');



Route::get('email/{id}','EmailController@index')->name('email');
Route::get('email/create','EmailController@create')->name('email.create');
Route::post('email/store','EmailController@store')->name('email.store');
Route::get('email/edit/{id}','EmailController@edit')->name('email.edit');
Route::post('email/update/{id}','EmailController@update')->name('email.update');
Route::post('email/destroy','EmailController@destroy')->name('email.destroy');

});

