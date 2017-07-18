<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
	public function addusersedding()
	{
		$user=User::all();
		$category=Category::all();
		return view('admin.pages.adduserseed',['user'=>$user,'category'=>$category]);
	}

	public function getDangnhap()
	{
		return view('login');
	}
	public function postDangnhap(Request $request)
	{
		$this->validate($request,
			[
			'email'=>'required|max:50|email',
			'password'=>'required|min:3|max:32'
			],
			[
			
			]);
		if (Auth::attempt(['email' =>$request->email, 'password' => $request->password])) {
			if(Auth::user()->role_id==2)
			{
				return redirect('subadmin/taolink');
			}
			else if(Auth::user()->role_id==1)
			{
				return redirect('admin/taolink');
			}
			else
			{
				return redirect('user/taolink');
			}
		}
		//neu dang nhap thanh cong
		
		else
		{
			return redirect('/')->with('thongbao','Sai tên tài khoản hoặc mật khẩu');
		}
	}





	public function getList()
	{
		$user=User::all();
		return view('admin.user.list',['userr'=>$user]);
	}
	public function getAdd()
	{
		return view('admin.user.add');
	}
	public function postAdd(Request $request)
	{

		$this->validate($request,
			[
			'name'=>'required|min:5|max:50', 
			'email'=>'required|email|unique:users,email', 
			'password'=>'required|min:3|max:32',
			'repassword'=>'required|same:password'
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
			'repassword.required'=>'Vui lòng nhập xác nhận mật khẩu',
			'repassword.same'=>'Mật khẩu xác nhận không đúng'
			]);
		$total=User::max('id');
		$idus=$total+1;
		$user = new User;
		$user->id=$idus;
		$user->name=$request->name;
		$user->email=$request->email;
		$user->quyen=$request->quyen;
		$user->password=bcrypt($request->password);
		$user->save();
		return redirect('admin/user/add')->with('thongbao','Đã thêm thành công');
	}
	public function getEdit($id)
	{
		$id=(int)$id;
		$userr=User::find($id);
		return view('admin.user.edit',['userr'=>$userr]);
	}
	public function postEdit($id,Request $request)
	{
		$this->validate($request,
			[
			'name'=>'required|min:5|max:50', 
			],
			[
			'name.required'=>'Vui  lòng nhập tên họ tên',
			'name.min'=>'Họ tên tối thiểu 5 ký tự',
			'name.max'=>'Tên quá dài',
			]);
		$id=(int)$id;
		$user=User::find($id);
		$user->name=$request->name;
		$user->quyen=(int)$request->quyen;
		if($request->changePassword=="on")
		{
			$this->validate($request,
				[
				'password'=>'required|min:3|max:32',
				'repassword'=>'required|same:password'
				],
				[
				'password.required'=>'Vui lòng nhập mật khẩu',
				'password.min'=>'Mật khẩu tối thiểu 3 ký tự',
				'password.max'=>'Mật khẩu tối đa 32 ký tự',
				'repassword.required'=>'Vui lòng nhập xác nhận mật khẩu',
				'repassword.same'=>'Mật khẩu xác nhận không đúng'
				]);
			$user->password=bcrypt($request->password);
		}
		
		$user->save();
		return redirect('admin/user/edit/'.$id)->with('thongbao','Đã sửa thành công');
	}

	public function getDelete($id)
	{
		$id=(int)$id;
		$user=User::find($id);
		$user->delete();
		return redirect('admin/user/list')->with('thongbao','Đã xóa người dùng:'.$user->email);
	}
	public function getLogout()
	{
		Auth::logout();
		return redirect('/');
	}

}
