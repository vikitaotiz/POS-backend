<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');

    Route::post('/pin_login', 'AuthController@pin_login');
    
});

Route::get('/user', 'AuthController@user')->middleware('auth:api');

Route::apiResource('/departments', 'DepartmentController')->middleware('auth:api');
Route::apiResource('/roles', 'RoleController')->middleware('auth:api');


Route::apiResource('/cancels', 'CancelController')->middleware('auth:api');

Route::get('/loggedinusers', 'LoggedInUserController@index');
Route::post('/loggedinusers', 'LoggedInUserController@store')->middleware('auth:api');

Route::delete('/loggedinusers/{id}', 'LoggedInUserController@destroy')->middleware('auth:api');

Route::apiResource('/loggers', 'LoggerController')->middleware('auth:api');

Route::apiResource('/categories', 'CategoryController')->middleware('auth:api');

Route::apiResource('/products', 'ProductController')->middleware('auth:api');

Route::apiResource('/addons', 'AddonController')->middleware('auth:api');

Route::apiResource('/carts', 'CartController')->middleware('auth:api');

Route::apiResource('/drinks', 'DrinkController')->middleware('auth:api');

Route::apiResource('/picks', 'PickController')->middleware('auth:api');

Route::apiResource('/sales', 'SaleController')->middleware('auth:api');

Route::apiResource('/users', 'UserController')->middleware('auth:api');

Route::apiResource('/tables', 'TableController')->middleware('auth:api');

Route::apiResource('/readies', 'ReadyController')->middleware('auth:api');

Route::apiResource('/bills', 'BillController')->middleware('auth:api');

Route::apiResource('/adds', 'AddController')->middleware('auth:api');
Route::apiResource('/adddrinks', 'AdddrinkController')->middleware('auth:api');
Route::apiResource('/addpicks', 'AddpickController')->middleware('auth:api');

Route::get('password', 'MpesaController@lipaNaMpesaPassword');

Route::post('token', 'MpesaController@generateAccessToken');
Route::post('mpesapay', 'MpesaController@customerMpesaSTKPush')->middleware('auth:api');

Route::post('validation', 'MpesaController@mpesaValidation')->middleware('auth:api');
Route::post('transaction/confirmation', 'MpesaController@mpesaConfirmation')->middleware('auth:api');
Route::post('register/url', 'MpesaController@mpesaRegisterUrls')->middleware('auth:api');