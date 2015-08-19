<?php

use Mbbender\Cohort\Http\Controllers\Account;

// User Registration
Route::get('account/signup', ['as'=>'account.signup', 'uses'=> RegisterController::class.'@signup']);
Route::post('account/signup',  RegisterController::class.'@processSignup');

// User Authentication
Route::get('account/login', ['as'=>'account.login', 'uses'=>AuthController::class.'@login']);
Route::post('account/login', AuthController::class.'@processLogin');

Route::get('account/logout', ['as'=>'account.logout', 'uses'=>AuthController::class.'@logout']);

Route::get('account/password/forgot', ['as'=>'account.password.forgot', 'uses'=> PasswordController::class.'@findByEmail']);
Route::post('account/password/forgot', PasswordController::class.'@sendPasswordResetEmail');
Route::get('account/password/reset', ['as'=>'account.password.reset', 'uses'=>PasswordController::class.'@reset']);
Route::post('account/password/reset', PasswordController::class.'@processReset');

// Social User Authentication
Route::get('account/oauth/{provider}', ['as'=>'oauth.redirect', 'uses'=> OauthController::class.'@redirectToProvider']);
Route::get('account/oauth/callback/{provider}', ['as'=>'oauth.callback', 'uses'=>OauthController::class.'@handleProviderCallback']);
