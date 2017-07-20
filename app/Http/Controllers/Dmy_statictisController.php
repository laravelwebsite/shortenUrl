<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dmy_statictis;
use App\Seeder;
use App\User;
class Dmy_statictisController extends Controller
{
	 public function statictisDetail($shortcut_url)
	 {
	 	$dmy_statictis=Dmy_statictis::where('shortcut_url',$shortcut_url)->get();
	 	$seeder=Seeder::where('shortcut_url',$shortcut_url)->get();
	 	return view('statictisDetail',['dmy_statictis'=>$dmy_statictis,'seeder'=>$seeder]);
	 	
	 }
}
