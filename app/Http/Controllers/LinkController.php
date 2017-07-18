<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\Count;
use Illuminate\Support\Facades\Auth;
class LinkController extends Controller
{
	public function getList()
	{
		$link=Link::orderBy('id','DESC')->get();
		return view('admin.link.list',['link'=>$link]);
	}
	public function getAdd()
	{
		return view('admin.link.add');
	}

	public function postAdd(Request $request)
	{
		$this->validate($request,
			[
			'link'=>'required|min:5|max:500',
			],
			[
			
			]);
		$domain=$_SERVER['SERVER_NAME'];
		$random=substr(md5(rand(0,9)),0,7);
		$check=Link::where('random',$random)->first();
		while(count($check)>0)
		{
			$random=substr(md5(rand(0,9)),0,5);
			$check=Link::where('random',$random)->first();
		}

		$shortlink=$_SERVER['SERVER_NAME']."/".$random;

		$links=new Link;
		$idlinkss=Link::max('id');
		$id=$idlinkss+1;
		$links->id=$id;
		$links->link=$request->link;
		$links->random=$random;
		$links->shortlink=$shortlink;
		$links->idUser=Auth::user()->id;
		if($request->advanced=="on")
		{
			$this->validate($request,
				[
				'title'=>'required|min:5|max:255',
				'description'=>'required|min:5|max:500',
				'images'=>'required',
				],
				[
				
				]);
			$links->title=$request->title;
			$links->description=$request->description;
			if($request->hasFile('images'))
			{
				$file=$request->file('images');
		            $name=$file->getClientOriginalName();//lay ra ten file
		            $duoi=$file->getClientOriginalExtension();//llay ra duoi file
		            if($duoi!= 'png' && $duoi != 'jpg' && $duoi != 'jpeg')
		            {
		            	return redirect('admin/link/add')->with('loi','Định dạng đuôi file không đúng.Bạn chỉ được upload file có đuôi jpg,jpeg,png');
		            }
		            $hinh=str_random(10)."_".$name;//random  va noi dau _ de khong trung ten
		            while(file_exists("upload/imagesupload/".$hinh))//neu van trung thi random tiep
		            {
		            	$hinh=str_random(10)."_".$name;
		            }
		            $file->move('upload/imagesupload',$hinh);//vi tri luu va ten file
		            $links->image=$hinh;
		        }
		        else
		        {
		        	$links->image="";
		        }
		    }
		    $links->save();
		    $count=new Count;
		    $idcount=Count::max('id');
		    $idc=$idcount+1;
		    $count->id=$idc;
		    $count->idlink=$id;
		    $count->countdate=0;
		    $count->countweek=0;
		    $count->countmonth=0;
		    $count->countyear=0;
		    $count->totalcount=0;
		    $count->save();
		    return redirect('admin/link/add')->with('shortlink',$shortlink);
	}
	public function getDelete($id)
	{
		$id=(int)$id;
		$link=Link::find($id);
		$link->delete();
		return redirect('admin/link/list')->with('thongbao','Đã xóa người dùng:'.$link->link);
	}
	}
