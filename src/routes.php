<?php 

Route::group(['middleware' => 'web'], function () {

	/*Route::group(['namespace' => 'App\Http\Controllers\Auth'], function() {

		// Password Reset Routes...
		Route::get('password/reset/{token?}', 'PasswordController@showResetForm');
		Route::post('password/email', 'PasswordController@sendResetLinkEmail');
		Route::post('password/reset', 'PasswordController@reset');

	});*/

	/**
	 * Authentication Routes
	 */
	Route::group(['namespace' => 'ApartmentCMS\ApartmentCMS\Auth'], function() {

		Route::get('login', 'LoginController@showLoginForm');
		Route::post('login', 'LoginController@login');
		Route::get('logout', 'LoginController@logout');

	});

	/**
	 * Application Routes
	 */
	Route::group(['namespace' => 'ApartmentCMS\ApartmentCMS\Controllers'], function() {

		/**
		 * CMS Routes
		 */
		Route::group(['middleware' => 'auth'], function() {
			
			Route::get('/admin', 
		  		'Cms\PageController@home');

			/**
			 * Pages
			 */
			Route::get('/admin/pages', 
		  		'Cms\PageController@create');

			Route::post('/admin/pages', 
		  		'Cms\PageController@store');

			Route::get('/admin/pages/{slug}', 
		  		'Cms\PageController@edit');

			Route::post('/admin/pages/{slug}', 
		  		'Cms\PageController@update');

			/**
			 * Buckets
			 */
		});	

		/**
		 * Frontend Routes
		 */
		Route::get('/', 
		  'PageController@home');

		Route::get('/{slug}', 
		  'PageController@show');

		Route::get('/{slug}/{item}',
			'PageController@show');

	});

});