<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dmy_statictis;
use App\Seeder;
class Dmy_statictisController extends Controller
{
	 public function statictisDetail($shortcut_url)
	 {
	 	$dmy_statictis=Dmy_statictis::where('shortcut_url',$shortcut_url)->get();
	 	$seeder=Seeder::where('shortcut_url',$shortcut_url)->get();
	 	if(Auth::user()->role_id==1)
	 	{
	 		return view('admin.pages.statictisDetail',['dmy_statictis'=>$dmy_statictis,'seeder'=>$seeder]);
	 	}
	 	else if(Auth::user()->role_id==2)
	 	{
	 		return view('subadmin.pages.statictisDetail',['dmy_statictis'=>$dmy_statictis,'seeder'=>$seeder]);
	 	}
	 	else
	 	{
	 		return view('users.pages.statictisDetail',['dmy_statictis'=>$dmy_statictis,'seeder'=>$seeder]);
	 	}
	 	
	 }
}
