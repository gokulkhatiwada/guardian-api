<?php

Route::get('/','DashboardController')->name('dashboard');

Route::get('/settings','SettingController@index')->name('setting');
Route::post('/settings','SettingController@update')->name('setting.update');

Route::get('/api-credentials','GuardianApiController@index')->name('guardian.api');
Route::post('/api-credentials','GuardianApiController@update')->name('guardian.api.update');

Route::prefix('categories')->group(function(){
   Route::get('/','CategoryController@index')->name('category.index');
   Route::post('/create','CategoryController@store')->name('category.store');
   Route::get('/update/{slug}','CategoryController@edit')->name('category.edit');
   Route::post('/update/{slug}','CategoryController@update')->name('category.update');
   Route::get('/delete/{slug}','CategoryController@destroy')->name('category.delete');
});

Route::get('/logs','LogController@index')->name('logs');
Route::get('/log-files','LogController@logFiles')->name('log.files');
Route::get('/log-file-content','LogController@getFileContent')->name('log.file.content');
Route::get('/download-log','LogController@downloadLogs')->name('log.download');