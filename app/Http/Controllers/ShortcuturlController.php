<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Shortcut_url;
use App\List_job_id;
use App\User;
use App\Category;
class ShortcuturlController extends Controller
{
    	public function getTaolink()
	{
		if(Auth::user()->role_id==0)
		{
			return view('users.pages.taolink');
		}
		else
		{
			return view('subadmin.pages.taolink');
		}
		
	}
	public function getTaolinkAdmin()
	{
		$category =Category::all();
		$user=User::where('role_id',0)->get();
		return view('admin.pages.taolink',['user'=>$user,'category'=>$category]);
	}
	public function postTaolink(Request $request)
	{
		$this->validate($request,
			[
			'url'=>'required|min:5|max:500|url',
			]);
		$defaultLink=$request->url;
		$parse_url= parse_url($defaultLink);
		$links=new Shortcut_url;
		$idlinkss=Shortcut_url::max('id');
		$id=$idlinkss+1;
		$links->id=$id;
			//purpose
		$links->purpose=$request->purpose;
		$links->count_click=0;//count
		if($request->job_id=="")
		{
			$links->job_id="N/A";
		}
		else
		{
			$links->job_id=$request->job_id;
		}
		$links->iduser_create=Auth::user()->id;
		//subadmin thi khoi duyet
		if(Auth::user()->role_id==0)
		{
			$links->wait_check=0;
		}
		else
		{
			$links->wait_check=1;
		}
		$links->source=0;
		$links->email_user   = Auth::user()->email;
		//shortcut_url
		//$domain=$_SERVER['SERVER_NAME'];
		$random=substr(md5(rand(0,9)),0,7);
		$check=Shortcut_url::where('shortcut_url',$random)->first();
		while(count($check)>0)
		{
			$random=substr(md5(rand(0,9)),0,5);
			$check=Shortcut_url::where('shortcut_url',$random)->first();
		}
		$links->shortcut_url=$random;
			if($request->hasFile('fileUpload'))
				{
					$file=$request->file('fileUpload');
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
				            $links->fileupload_name=$hinh;
			        	}
				else
				{
				        	$links->fileupload_name="";
				}
			$links->title=$request->title;
			$links->description=$request->description;
			$links->date_begin_seeder=$request->date_begin_seeder;
			$links->id_user_seeder=-1;
			$links->category_id=9;
			if ($parse_url['host'] == 'topdev.vn' && strpos($defaultLink, 'detail-jobs') !== FALSE)
			      {

			        // $links_redirect = $defaultLink.'/?seeder_id='.$this->session->userdata('user_id');
				        if($parse_url['host'] == 'topdev.vn' && strpos($defaultLink, '?token') === FALSE ) $links_redirect = $defaultLink.'/?seeder_id='.Auth::user()->id;
				        elseif($parse_url['host'] == 'topdev.vn' && strpos($defaultLink, '?token') !== FALSE ) $links_redirect = $defaultLink.'&seeder_id='.Auth::user()->id;
				        

				        $whatIWant = substr($defaultLink,strrpos($defaultLink, "-") + 1);
				        if(strpos($whatIWant, '//?token') !== FALSE) $whatIWant = stristr($whatIWant, '//?token', true);
				        elseif(strpos($whatIWant, '/?token') !== FALSE) $whatIWant = stristr($whatIWant, '/?token', true);
				        elseif(strpos($whatIWant, '?token') !== FALSE) $whatIWant = stristr($whatIWant, '?token', true);
				        
				        if(strpos($whatIWant, '//?seeder_id') !== FALSE) $whatIWant = stristr($whatIWant, '//?seeder_id', true);
				        elseif(strpos($whatIWant, '/?seeder_id') !== FALSE) $whatIWant = stristr($whatIWant, '/?seeder_id', true);
				        
				       $links->job_id= $whatIWant;
			      }
			      else 
			      {
			      	        $links_redirect = $defaultLink;
			      }
			$links->redirect=$links_redirect;
			$links->save();
			if(Auth::user()->role_id==0)
			{
				return redirect('user/taolink')->with('thongbao',"Vào <b>Thống kê</b> để nhận link shorten !!");
			}
			else
			{
				return redirect('subadmin/taolink')->with('thongbao',"Vào <b>Thống kê</b> để nhận link shorten !!");
			}
		//user add
	
	}


	public function postTaolinkAdmin(Request $request)
	{
		$this->validate($request,
			[
			'url'=>'required|min:5|max:500|url',
			]);
		$defaultLink=$request->url;
		$parse_url= parse_url($defaultLink);
		$links=new Shortcut_url;
		$idlinkss=Shortcut_url::max('id');
		$id=$idlinkss+1;
		$links->id=$id;
		$random=substr(md5(rand(0,9)),0,7);
		$check=Shortcut_url::where('shortcut_url',$random)->get();
		while(count($check)>0)
		{
			$random=substr(md5(rand(0,9)),0,5);
			$check=Shortcut_url::where('shortcut_url',$random)->first();
		}
		$links->shortcut_url=$random;
		$links->category_id=$request->category;
		$links->purpose=$request->purpose;
		$links->iduser_create=Auth::user()->id;
		$links->email_user   = Auth::user()->email;
		$links->wait_check=0;
		$links->count_click=0;//count
		$links->source=0;
		
		if($request->job_id=="")
		{
			$links->job_id="N/A";
		}
		else
		{
			$links->job_id=$request->job_id;
		}
		if($parse_url['host'] == 'topdev.vn' && strpos($defaultLink, '?token') === FALSE ) $links_redirect = $defaultLink.'/?seeder_id='.Auth::user()->id;
		        elseif($parse_url['host'] == 'topdev.vn' && strpos($defaultLink, '?token') !== FALSE ) $links_redirect = $defaultLink.'&seeder_id='.Auth::user()->id;
		        elseif($parse_url['host'] == 'topdev.vn' && strpos($redirect, 'detail-jobs') !== FALSE) $links_redirect = $defaultLink.'/?seeder_id='.Auth::user()->id;
		        else $links_redirect = $defaultLink;

		$links->redirect= $links_redirect;
		if($request->category==3 || $request->category=9)
		{
				if($request->hasFile('fileUpload'))
				{
					$file=$request->file('fileUpload');
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
				            $links->fileupload_name=$hinh;
			        	}
				else
				{
				        	$links->fileupload_name="";
				}
				$links->title=$request->title;
				$links->region = "";
				$links->description=$request->description;
				//$links->id_user_seeder=(array)$request->seeder_id;
				$links->date_begin_seeder=$request->date_begin_seeder;
				if($request->category==3)
				{
					if($parse_url['host'] == 'topdev.vn') $links_redirect = $defaultLink;
				          //$links->redirect    = $links_redirect;
				          if($request->seeder_id){
				            foreach ($request->seeder_id as $value) 
				            {
					              $links=new Shortcut_url;
						  $idlink1=Shortcut_url::max('id');
						  $idlink1=$idlink1+1;
						  $links->id=$idlink1;
						  $links->shortcut_url=$random;
						  $links->category_id=$request->category;
						  $links->purpose=$request->purpose;
						  $links->iduser_create=Auth::user()->id;
						  $links->email_user   = Auth::user()->email;
						  $links->wait_check=0;
						  $links->count_click=0;//count
						  $links->source=0;
						  $links->title=$request->title;
						  $links->region = "";
						  $links->description=$request->description;
						if($request->job_id=="")
						{
							$links->job_id="N/A";
						}
						else
						{
							$links->job_id=$request->job_id;
						}
						  if($request->hasFile('fileUpload'))
						{
							
						            $links->fileupload_name=$hinh;
					        	}
						else
						{
						        	$links->fileupload_name="";
						}
						//$links->id_user_seeder=(array)$request->seeder_id;
						$links->date_begin_seeder=$request->date_begin_seeder;
					              $links->id_user_seeder=$value;
					              $links->redirect= $defaultLink.'/?seeder_id='.$value;
					              $links->save();
				           }
				            $dataMess = "Vào danh sách chờ duyệt để cập nhật nội dung seeder !!";
				          }
				          else
				          {
				          	$links->id_user_seeder=-1;
				            $links->shortcut_url=$random;
				            $links->save();
				            $dataMess ="Vào danh sách chờ duyệt để cập nhật nội dung seeder !!";
				          }
				}
				//Others
				else
				{
					
				            $links->id_user_seeder=-1;
				            $links->save();
				            $dataMess ="Vào danh sách chờ duyệt để cập nhật nội dung seeder !!";
				          // add complete
				}

		}
		else
		{
			if($request->category == 8){
				$links->region = $request->region;
			}
			else
			{
				$links->region = "";
			}
			$links->fileupload_name="";
			$links->title="";
			$links->description="";
			$links->id_user_seeder=-1;
			$links->date_begin_seeder="";
			$links->save();
			$dataMess ="Vào danh sách chờ duyệt để cập nhật nội dung seeder !!";
				
		}
		return redirect('admin/taolink')->with('thongbao',$dataMess);
	}

	public function getStatictis()
	{

		$listjob=List_job_id::all();
		$iduser=Auth::user()->id;
		$danhsach=Shortcut_url::where('iduser_create',$iduser)->orderBy('created_at','DESC')->paginate(10);
		$count=$danhsach->count();
		if(Auth::user()->role_id==0)
		{
			return view('users.pages.statictis',['danhsach'=>$danhsach,'job_id'=>$listjob,'count'=>$count]);
		}
		else if(Auth::user()->role_id==2)
		{
			return view('subadmin.pages.statictis',['danhsach'=>$danhsach,'job_id'=>$listjob,'count'=>$count]);
		}
	}
	public function getStatictisadmin($id)
	{

		$listjob=List_job_id::all();
		$id=(int)$id;
		$danhsachid=Shortcut_url::where('iduser_create',$id)->orderBy('created_at','DESC')->paginate(10);
		$count=$danhsachid->count();
		return view('admin.pages.statictis',['danhsach'=>$danhsachid,'job_id'=>$listjob,'count'=>$count]);
	}
	public function deleteUrl($id)
	    {
	    	$id=(int)$id;
	    	$url=Shortcut_url::find($id);
	    	$url->delete();
	    	return redirect('user/statictis')->with('thongbao','Đã xóa ');
	    }

	public function affiliateTracking()
	{

		$listjob=List_job_id::all();
		$iduser=Auth::user()->id;
		$danhsach=Shortcut_url::where('iduser_create',$iduser)->where('wait_check',1)->where('source',1)->orderBy('created_at','DESC')->paginate(10);
		$count=$danhsach->count();
		if(Auth::user()->role_id==0)
		{
			return view('users.pages.statictis_seeder',['job_id'=>$listjob,'danhsach'=>$danhsach,'count'=>$count]);
		}
		else
		{
			return view('subadmin.pages.statictis_seeder',['job_id'=>$listjob,'danhsach'=>$danhsach,'count'=>$count]);
		}
	}
	public function getListcheck()
	{
		$listcheck=Shortcut_url::where('wait_check',0)->orderBy('created_at','DESC')->paginate(10);
		$user=User::where('role_id',0)->get();
		return view('admin.pages.listcheck',['listcheck'=>$listcheck,'user'=>$user]);
	}

	public function trackCampaign()
	{
		$track =Shortcut_url::where('wait_check',1)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
		$category =Category::all();
		if(Auth::user()->role_id==1)
		{
			return view('admin.pages.trackcampaign',['track'=>$track,'category'=>$category]);
		}
		else
		{
			return view('subadmin.pages.trackcampaign',['track'=>$track,'category'=>$category]);
		}
	}
	public function affiliateTrack()
	{
		$track1 =Shortcut_url::where('wait_check',1)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
		if(Auth::user()->role_id==1)
		{
			return view('admin.pages.affiliatetrack',['track1'=>$track1]);
		}
		else
		{	$user=User::all();
			return view('subadmin.pages.affiliatetrack',['track1'=>$track1,'user'=>$user]);
		}
		
	}
}
