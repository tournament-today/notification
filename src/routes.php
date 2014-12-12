<?php
Route::group(['namespace' => 'Syn\Notification\Controllers'], function()
{
	Route::group([
		'before' 	=> ['auth', 'csrf'],
	], function()
	{

		Route::model('gamer', 'Syn\Gamer\Models\Gamer');
//		Route::any('/steam/sign-in', [
//			'as' => 'Steam@signIn',
//			'uses' => 'SteamOpenIdController@signIn'
//		]);
		Route::any('/{gamer}/{name}/notifications', [
			'as' => 'Gamer@ajaxNotifications',
			'uses' => 'NotificationController@ajax'
		]);
	});
});