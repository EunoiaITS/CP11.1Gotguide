<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'WebController@home');
Route::post('search-result', 'WebController@searchResult');
Route::get('search-result', 'WebController@searchResult');
Route::get('tour-guides/profile/{id}', 'WebController@showAgentProfile');
Route::get('sign-in/user', 'WebController@userLogin');
Route::get('sign-in/guide', 'WebController@guideLogin');
Route::post('sign-in/user', 'WebController@userLogin');
Route::post('sign-in/guide', 'WebController@guideLogin');
Route::get('profile/user', 'WebController@userProfile');
Route::get('profile/guide', 'WebController@guideProfile');
Route::post('register/guide', 'WebController@guideRegister');
Route::post('register/user', 'WebController@userRegister');
Route::any('ulogout', 'WebController@user_logout');
Route::any('glogout', 'WebController@guide_logout');
Route::get('profile/guide/check-reviews/','WebController@checkReviews');
Route::get('profile/edit/guide', 'WebController@editGuideProfile');
Route::post('profile/edit/guide', 'WebController@editGuideProfile');
Route::get('profile/edit/user/', 'WebController@editUserProfile');
Route::post('profile/edit/user/', 'WebController@editUserProfile');
Route::post('add-ad', 'WebController@addAvailabilities');
Route::post('add-packages', 'WebController@addPackages');
Route::post('edit-ad', 'WebController@editAvailabilities');
Route::post('edit-packages', 'WebController@editPackages');
Route::post('delete-ad', 'WebController@deleteAvailabilities');
Route::post('delete-packages', 'WebController@deletePackages');
Route::post('rate-guide', 'WebController@rateGuide');
Route::get('reviews/{id}', 'WebController@checkGuideReviews');
Route::get('forget-password', 'ForgetPasswordController@webForgetPassword');
Route::post('forget-password', 'ForgetPasswordController@webForgetPassword');
Route::get('forget-password/success', 'ForgetPasswordController@webForgetPasswordSuccess');
Route::get('reset-password/success', 'ForgetPasswordController@webResetPasswordSuccess');
Route::get('account/user/verify/{link}', 'WebController@verifyUserAccount');
Route::get('account/guide/verify/{link}', 'WebController@verifyGuideAccount');
Route::post('subscription/buy', 'WebController@buySubscription');
Route::post('contact/form', 'WebController@contact');


Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function(){
    Route::resource('packages', 'PackagesController');
    Route::post('agent-packages', 'PackagesController@packageByAgent');
    Route::post('search', 'UserController@multipleFieldSearch');
});

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function(){
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('login', 'AuthenticateController@authenticate');
    Route::get('login', 'AuthenticateController@getAuthenticatedUser');
    Route::post('password/reset', 'UserController@resetPassword');
});

Route::group(['middleware' => 'cors','prefix' => 'api/v1'], function () {
    Route::resource('user', 'UserController');
    Route::post('search-users-role', 'UserController@searchByRole');
    Route::post('user/edit/{id}', 'UserController@editUser');
    Route::get('search/paid-agents', 'UserController@searchAgentByPaid');
});

Route::post('api/v1/register', 'UserHandlerController@register');

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function(){
    Route::resource('ratings', 'RatingsController');
    Route::get('agent-rating/{id}', 'RatingsController@totalRatingOfAgent');
    Route::get('comments-per-agent/{id}', 'RatingsController@commentsOnAgent');
});

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function(){
    Route::resource('payment-offers', 'PaymentConfigController');
});

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function(){
    Route::resource('payments', 'UserPaymentsController');
    Route::post('agent-payment', 'UserPaymentsController@paymentByAgent');
});

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function(){
    Route::resource('available-dates', 'AvailableDatesController');
});

Route::get('api/v1/forgot-password/{link}', 'ForgetPasswordController@getView');
Route::post('api/v1/forgot-password/{link}', 'ForgetPasswordController@getView');

Route::post('api/v1/request-password-reset', 'ForgetPasswordController@requestResetPassword');
Route::post('api/v1/process-password-reset', 'ForgetPasswordController@processResetPassword');
