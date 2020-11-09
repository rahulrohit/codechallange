<?php

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
	if (Auth::check()) {
		return redirect()->intended('dashboard');
	}else{
		return view('login'); 
	}
});

Route::get('login', function () { 
	if (Auth::check()) {
		return redirect()->intended('dashboard');
	}else{
		return view('login'); 
	}
});

Route::get('users', function () { 
	return view('users');
});
Route::get('users','UsersController@users');
Route::post('users','UsersController@usersformPost');

Route::get('users','UsersController@index');
Route::get('rahul','UsersController@rahul');
Route::get('userRoles','RoleController@index');

Route::post('userRoles','RoleController@roleadd');

Route::get('deleterole/{id}', 'RoleController@destroy');

Route::get('editrole', 'RoleController@edit');

Route::get('folder', array('as' => 'Add-tickets','uses' => 'FolderController@folder'));
Route::post('folder-show', array('as' => 'storepage','uses' => 'FolderController@store'));
Route::get('folder-list', array('as' => 'storepage','uses' => 'FolderController@index'));
Route::get('folder-delete', array('as' => 'deletepage','uses' => 'FolderController@destroy'));
Route::get('/folder/delete/{id}', 'FolderController@destroy')->name('folder.delete');
Route::get('viewfolder/{id}', array('as' => 'view-folder','uses' => 'FolderController@folderpage'));


Route::get('files', array('as' => 'Add-tickets','uses' => 'FilesController@filesform'));
Route::post('files-show', array('as' => 'storepage','uses' => 'FilesController@store'));
Route::get('files-list', array('as' => 'storepage','uses' => 'FilesController@index'));
//Route::get('filesdetails}', array('as' => 'storepage','uses' => 'FilesController@files'));
Route::get('/files/delete/{id}', 'FolderController@filedestroy')->name('files.delete');

Route::get('editroledata', 'RoleController@editroledatas');
Route::get('downloadExcel/{type}', 'RoleController@downloadExcel');
Route::get('loginapi', 'Auth\ApiLoginController@login');
Route::post('login', array('as' => 'login', 'uses' => 'Auth\LoginController@doLogin'));
Route::get('logout', array('as' => 'login', 'uses' => 'Auth\LoginController@doLogout'));
Route::any('dashboard', array('as' => 'Dashboard','uses' => 'HomeController@Dashboard'));

