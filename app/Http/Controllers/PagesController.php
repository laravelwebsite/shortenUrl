<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\Count;
use App\User;
use Illuminate\Support\Facades\Auth;
class PagesController extends Controller
{


	
	public function index()
	{
		return view('pages.home');
	}
	public function getDangky()
	{
		return view('pages.dangky');
	}
	public function postDangky(Request $request)
	{
		$this->validate($request,
			[
			'name'=>'required|min:5|max:50', 
			'email'=>'required|email|unique:users,email', 
			'password'=>'required|min:3|max:32',
			'passwordAgain'=>'required|same:password'
			],
			[
			'name.required'=>'Vui  lòng nhập tên họ tên',
			'name.min'=>'Họ tên tối thiểu 5 ký tự',
			'name.max'=>'Tên quá dài',

			'email.required'=>'Vui lòng nhập email',
			'email.email'=>'Email không đúng định dạng',
			'email.unique'=>'Email đã tồn tại',
			'password.required'=>'Vui lòng nhập mật khẩu',
			'password.min'=>'Mật khẩu tối thiểu 3 ký tự',
			'password.max'=>'Mật khẩu tối đa 32 ký tự',
			'passwordAgain.required'=>'Vui lòng nhập xác nhận mật khẩu',
			'passwordAgain.same'=>'Mật khẩu xác nhận không đúng'
			]);
		$total = User::max('id');
		$iduser=$total+1;
		$user = new User;
		$user->id=$iduser;
		$user->name=$request->name;
		$user->email=$request->email;
		$user->quyen=0;
		$user->password=bcrypt($request->password);
		$user->save();
		return redirect('dangky')->with('dangky','Đăng ký tài khoản thành công');
	}
	public function postDangnhap(Request $request)
	{
		$this->validate($request,
			[
			'email'=>'required|min:5|max:50',
			'password'=>'required|min:3|max:32'
			],
			[
			
			]);
		if (Auth::attempt(['email' =>$request->email, 'password' => $request->password])) {
			return redirect('trangchu/taolink');
		}
		//neu dang nhap thanh cong
		
		else
		{
			return redirect('/')->with('thongbao','Sai tên tài khoản hoặc mật khẩu');
		}
	}
	
	public function postTaolink(Request $request)
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
		            	return redirect('/')->with('loi','Định dạng đuôi file không đúng.Bạn chỉ được upload file có đuôi jpg,jpeg,png');
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

		    //tiep tuc luu vao table count
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
		    return redirect('/')->with('shortlink',$shortlink);
		}
		public function getRealink($string)
		{
			
			$find=Link::where('random',$string)->first();
			if(count($find)>0)
			{
				//cap nhat luot xem
				$count=Count::where('idlink',$find->id)->first();
				$count->totalcount=$count->totalcount+1;
				$created=$count->created_at->format('d');
				//lay ra lan truy cap truoc do la ngay bao nhieu
				$updated=$count->updated_at->format('d');
				$datenow = date('d');//lay ra lan truy cap nay
				//nếu lần truy cập ngày có ngày lớn hơn nghĩa là đã qua ngày,nên reset lại đếm ngày
				if($datenow==$updated)//chua qua ngay
				{
					$count->countdate=$count->countdate+1;
					$count->countweek=$count->countdate+1;
					$count->countmonth=$count->countdate+1;
					$count->countyear=$count->countdate+1;
				}
				//qua ngay moi
				else
				{
					//chua du 1 tuan thi 
					if($updated-$created<=7)
					{
						$count->countweek=($count->countweek)+($count->countdate);
					}
					else
					{
						$count->countweek=0;

					}
					if($updated-$created<=30)
					{
						$count->countmonth=($count->countmonth)+($count->countdate);
					}
					else
					{
						$count->countmonth=0;
					}
					if($updated-$created<=365)
					{
						$count->countyear=($count->countyear)+($count->countyear);
					}
					else
					{
						$count->countyear=0;
					}
					$count->countdate=0;
					
				}
				$count->save();
				$realLink=$find->link;
				//header('Location: '.$realLink);
				return redirect($realLink);
			}
			else
			{
				return view('errors.404');
			}
			
		}
		public function getDangxuat()
		{
			Auth::logout();
			return redirect('/');
		}

		public function getList()
		{
			$iduser=Auth::user()->id;
			$list=Link::where('idUser',$iduser)->orderBy('created_at','DESC')->get();
			return view('pages.listlink',['list'=>$list]);

		}
	}
