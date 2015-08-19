<?php

use Mbbender\Cohort\Http\Controllers as Cohort;

// User Registration
Route::get('account/signup', ['as'=>'account.signup', 'uses'=> Cohort\RegisterController::class.'@signup']);
Route::post('account/signup',  Cohort\RegisterController::class.'@processSignup');

// User Authentication
Route::get('account/login', ['as'=>'account.login', 'uses'=>Cohort\AuthController::class.'@login']);
Route::post('account/login', Cohort\AuthController::class.'@processLogin');

Route::get('account/logout', ['as'=>'account.logout', 'uses'=>Cohort\AuthController::class.'@logout']);

Route::get('account/password/forgot', ['as'=>'account.password.forgot', 'uses'=> Cohort\PasswordController::class.'@findByEmail']);
Route::post('account/password/forgot', Cohort\PasswordController::class.'@sendPasswordResetEmail');
Route::get('account/password/reset', ['as'=>'account.password.reset', 'uses'=>Cohort\PasswordController::class.'@reset']);
Route::post('account/password/reset', Cohort\PasswordController::class.'@processReset');

// Social User Authentication
Route::get('account/oauth/{provider}', ['as'=>'oauth.redirect', 'uses'=> Cohort\OauthController::class.'@redirectToProvider']);
Route::get('account/oauth/callback/{provider}', ['as'=>'oauth.callback', 'uses'=>Cohort\OauthController::class.'@handleProviderCallback']);
