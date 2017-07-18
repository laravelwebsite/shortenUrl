<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Messager;
use App\User;
class MessagerController extends Controller
{
    public function getMessager()
    {
    	$messager=Messager::where('email_user',Auth::user()->email)->paginate(10);
    	if(Auth::user()->role_id==0)
    	{
    		return view('users.pages.messager',['messager'=>$messager]);
    	}
    	else
    	{
    		return view('subadmin.pages.messager',['messager'=>$messager]);
    	}
    }
    public function sentmessenger()
    {
        $user=User::where('role_id',0)->get();
        return view('admin.pages.sentmessenger',['user'=>$user]);
    }
}
