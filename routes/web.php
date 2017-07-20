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

Route::get('/','UserController@getDangnhap');

Route::get('home','UserController@getDangnhap');
Route::get('index.php','UserController@getDangnhap');
Route::get('trangchu','UserController@getDangnhap');
Route::post('login','UserController@postDangnhap');
Route::get('logout','UserController@getLogout');
Route::get('/{string}','ShortcuturlController@getReallink');

Route::group(['prefix'=>'user','middleware'=>'userLogin'],function(){
	Route::get('taolink','ShortcuturlController@getTaolink');
	Route::post('taolink','ShortcuturlController@postTaolink');
	Route::get('statictis','ShortcuturlController@getStatictis');
	Route::get('deleteajax','AjaxController@deleteUrl');
	Route::get('searchwithjobStatictis','AjaxController@searchwithjobStatictis');
	Route::get('statictis-details/{shortcut_url}','Dmy_statictisController@statictisDetail');
	Route::get('affiliateTracking','ShortcuturlController@affiliateTracking');
	Route::get('messengers','MessagerController@getMessager');
	Route::get('Ajaxmessengers','AjaxController@getMessagercontent');

});
Route::group(['prefix'=>'subadmin','middleware'=>'subadminLogin'],function(){
	Route::get('taolink','ShortcuturlController@getTaolink');
	Route::get('statictis','ShortcuturlController@getStatictis');
	Route::get('statictis-details/{shortcut_url}','Dmy_statictisController@statictisDetail');
	Route::get('affiliateTracking','ShortcuturlController@affiliateTracking');
	Route::get('trackCampaign','ShortcuturlController@trackCampaign');
	Route::get('affiliate-Track','ShortcuturlController@affiliateTrack');
	Route::get('messengers','MessagerController@getMessager');
	Route::get('Ajaxmessengers','AjaxController@getMessagercontent');

});
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){

	Route::get('taolink','ShortcuturlController@getTaolinkAdmin');
	Route::post('taolink','ShortcuturlController@postTaolinkAdmin');
	Route::get('list-Check','ShortcuturlController@getListcheck');
	Route::get('deleteajaxadmin','AjaxController@deleteUrl');
	Route::get('ListCheck','AjaxController@ListCheck');
	Route::get('UpContSeeder','AjaxController@UpContSeeder');
	Route::get('trackCampaign','ShortcuturlController@trackCampaign');
	Route::get('statictis-details/{shortcut_url}','Dmy_statictisController@statictisDetail');
	Route::get('searchwithjobTrackcampaign','AjaxController@searchwithjobTrackcampaign');
	Route::get('affiliate-Track','ShortcuturlController@affiliateTrack');
	Route::get('searchwithjobAffiate','AjaxController@searchwithjobAffiate');
	Route::get('sent-messenger','MessagerController@sentmessenger');
	Route::get('add-user-sedding','UserController@addusersedding');
	Route::get('edit-user-sedding/{id}','UserController@editusersedding');
	Route::get('statictis-seeder/{id}','ShortcuturlController@getStatictisadmin');
	Route::get('deleteuserajax','AjaxController@deleteuserajax');
	Route::get('add-category','CategoryController@addCategory');
	Route::post('addcategory','AjaxController@addCategory');
	Route::post('deletecateajax','AjaxController@deleteCategory');
	Route::get('edit-category/{id}','CategoryController@editCategory');

	Route::post('adduser','AjaxController@adduser');
});
