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

Route::get('/get-rate', 'DashboardController@getRate');

Route::group(['middleware'=>'auth'], function (){

    Route::get('/buycoin', 'DashboardController@buycoin')->name('dashboard.buycoin');

    Route::get('/editprofile', 'AuthController@editprofile')->name('editprofile');
    Route::post('/editprofile', 'AuthController@posteditprofile')->name('posteditprofile');
    Route::post('/editwallet', 'AuthController@posteditwallet')->name('posteditwallet');
    Route::get('/changepassword', 'AuthController@changepassword')->name('changepassword');
    Route::post('/changepassword', 'AuthController@postchangepassword')->name('postchangepassword');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/delete', 'AuthController@delete')->name('delete');
    Route::get('/transactions', 'TransactionController@index')->name('transaction.index');
    Route::post('/transactions/datatables', 'TransactionController@datatables')->name('transaction.datatables');

    Route::post('/getTransactionId', 'DashboardController@getTransactionId');
});

Route::get('/buycoin/success/{id}', 'DashboardController@success')->name('dashboard.success');
Route::get('/buycoin/fail/{id}', 'DashboardController@fail')->name('dashboard.fail');
Route::get('/buycoin/status/{id}', 'DashboardController@status')->name('dashboard.status');

Route::get('/', 'DashboardController@index')->name('dashboard.index');


Route::get('/faq', 'FaqController@index')->name('faq.index');

Route::get('/contact-us', 'ContactController@index')->name('contact.index');
Route::post('/contact-send', 'ContactController@create')->name('contact.send');

Route::get('/sign-up', 'AuthController@signup')->name('auth.signup');
Route::post('/sign-up', 'AuthController@store')->name('auth.register');

Route::get('/login', 'AuthController@signin')->name('auth.signin');
Route::post('/login', 'AuthController@authenticate')->name('auth.postlogin');
Route::get('/reset-password', 'AuthController@resetpassword')->name('auth.resetpass');
Route::post('/postreset-password', 'AuthController@postresetpassword')->name('auth.postresetpass');
Route::get('/newpassword', 'AuthController@newpassword')->name('newpassword');
Route::post('/newpassword', 'AuthController@postnewpassword')->name('postnewpassword');

Route::get('/reset-verify', 'AuthController@resetverify')->name('auth.resetverify');
Route::post('/reset-postverify', 'AuthController@postresetverify')->name('auth.postresetverify');




Route::get('/aml-kyc-policy', 'AuthController@amlkycpolicy')->name('amlkycpolicy');
Route::get('/terms-of-service', 'AuthController@termsofservice')->name('termsofservice');
Route::get('/privacy-notice', 'AuthController@privacynotice')->name('privacynotice');


