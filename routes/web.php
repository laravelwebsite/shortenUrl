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
/*Route::get('/', 'PagesController@index');
Route::get('home', 'PagesController@index');
Route::get('trangchu', 'PagesController@index');
Route::get('dangky', 'PagesController@getDangky');
Route::post('dangky', 'PagesController@postDangky');
Route::post('dangnhap', 'PagesController@postDangnhap');
Route::get('dangxuat', 'PagesController@getDangxuat');
Route::get('{string}','PagesController@getRealink');
Route::group(['prefix'=>'trangchu','middleware'=>'userLogin'],function(){
	Route::get('taolink','PagesController@getTaolink');
	Route::post('taolink','PagesController@postTaolink');
	Route::get('list','PagesController@getList');
});
*/
Route::get('/','UserController@getDangnhap');
Route::get('home','UserController@getDangnhap');
Route::get('trangchu','UserController@getDangnhap');
Route::post('login','UserController@postDangnhap');
Route::get('logout','UserController@getLogout');

Route::group(['prefix'=>'user','middleware'=>'userLogin'],function(){
	Route::get('taolink','ShortcuturlController@getTaolink');
	Route::post('taolink','ShortcuturlController@postTaolink');
	Route::get('statictis','ShortcuturlController@getStatictis');
	Route::get('deleteajax','AjaxController@deleteUrl');
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
	Route::get('searchwithjob','AjaxController@searchwithjob');
	Route::get('affiliate-Track','ShortcuturlController@affiliateTrack');
	Route::get('searchwithjobAffiate','AjaxController@searchwithjobAffiate');
	Route::get('sent-messenger','MessagerController@sentmessenger');
	Route::get('add-user-sedding','UserController@addusersedding');
	Route::get('adduser','AjaxController@adduser');
	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@getList');
		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');
		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');
		Route::get('delete/{id}','UserController@getDelete');
	});
	Route::group(['prefix'=>'link'],function(){
		Route::get('list','LinkController@getList');
		Route::get('add','LinkController@getAdd');
		Route::post('add','LinkController@postAdd');
		Route::get('edit/{id}','LinkController@getEdit');
		Route::post('edit/{id}','LinkController@postEdit');
		Route::get('delete/{id}','LinkController@getDelete');
	});
});