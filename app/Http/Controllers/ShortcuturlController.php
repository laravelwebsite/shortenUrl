<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Shortcut_url;
use App\List_job_id;
use App\User;
use App\Category;
use App\Seeder;
use App\Dmy_statictis;
class ShortcuturlController extends Controller
{
	public function getReallink(Request $request,$string)
	{
		$urlrandom=$string;
		//co rat nhieu row urlrandom giống nhau,khi cập nhật count_click thì cập nhật tất cả các row,nhưng chỉ truyền 1 row duy nhat ra view 
		$urlinfor=Shortcut_url::where('shortcut_url',$urlrandom)->get();
		if(count($urlinfor)==0)
		{
			header("Location: https://topdev.vn/"); die;
		}
		else
		{
			$inforurl=Shortcut_url::where('shortcut_url',$urlrandom)->first();//lấy ra 1 dòng duy nhất truyền ra view để lấy thông tin
			//update count_click cho tất cả các dòng có shortcut_url giong nhau
			foreach($urlinfor as $url)
			{
				$url->count_click=($url->count_click)+1;
				$url->save();
			}
			//luu tru cookie :setcookie($name, $value, $expire, $path, $domain)
		         setcookie($inforurl->shortcut_url, $inforurl->shortcut_url, time() + (86400 * 1), "/"); // 86400 = 1 day
		         //data seeder(xem trang gioi thieu)
		          if(isset($_SERVER['HTTP_REFERER'])){
		            if(strlen($_SERVER['HTTP_REFERER']) == 0){
		              $referer = 'http://'.$_SERVER['SERVER_NAME'];//nhập url trực tiếp thì lấy servername lam trang gioi thieu
		            }
		            else
		            {
		              $referer = $_SERVER['HTTP_REFERER'];//neu co trang gioi thieu thi lay 
		            }
		          }
		          else $referer = 'http://'.$_SERVER['SERVER_NAME'];
		          $seed=Seeder::where('referer',$referer)->first();
		          //neu co row seed nay roi thi update
		          if(count($seed)>0)
		          {
		          		$seed->shortcut_url=$urlrandom;
		          		$seed->referer=$referer;
		          		$seed->count_click=$seed->count_click+1;
		          		$seed->save();
		          }
		          else//chua co thi insert
		          {
		          		$seed=new Seeder;
		          		$ids=Seeder::max('id');
		          		$seed->id=$ids+1;
		          		$seed->shortcut_url=$urlrandom;
		          		$seed->referer=$referer;
		          		$seed->count_click=1;
		          		$seed->save();
		          }


		          $time_now = time();
		          /*date month year statictis*/
		          $dateNow = date('d-m-Y', $time_now);

		          $dmy=Dmy_statictis::where('shortcut_url',$urlrandom)->where('date_statistic',$dateNow)->first();
		          if(count($dmy)>0)//update khi con trong ngay
		          {
		          		$dmy->shortcut_url=$urlrandom;
		          		$dmy->count_click=(int)$dmy->count_click+1;
		          		$dmy->save();
		          }
		          else
		          {
		          		$dmy=new Dmy_statictis;
		          		$dmyid=Dmy_statictis::max('id');
		          		$dmy->id=$dmyid+1;
		          		$dmy->shortcut_url=$urlrandom;
		          		$dmy->count_click=1;
		          		$dmy->date_statistic=$dateNow;
		          		$dmy->save();
		          }
		          //week
		          $dateW = date('W', $time_now);
		          $dmy=Dmy_statictis::where('shortcut_url',$urlrandom)->where('date_week',$dateW)->first();
		          if(count($dmy)>0)//update khi con trong ngay
		          {
		          		$dmy->shortcut_url=$urlrandom;
		          		$dmy->count_click=$dmy->count_click+1;
		          		$dmy->save();
		          }
		          else
		          {
		          		$dmy=new Dmy_statictis;
		          		$dmyid=Dmy_statictis::max('id');
		          		$dmy->id=$dmyid+1;
		          		$dmy->shortcut_url=$urlrandom;
		          		$dmy->count_click=1;
		          		$dmy->date_week=$dateW;
		          		$dmy->save();
		          }

		          $dateM = date('m', $time_now);
		          $dmy=Dmy_statictis::where('shortcut_url',$urlrandom)->where('date_month',$dateM)->first();
		          if(count($dmy)>0)//update khi con trong ngay
		          {
		          		$dmy->shortcut_url=$urlrandom;
		          		$dmy->count_click=$dmy->count_click+1;
		          		$dmy->save();
		          }
		          else
		          {
		          		$dmy=new Dmy_statictis;
		          		$dmyid=Dmy_statictis::max('id');
		          		$dmy->id=$dmyid+1;
		          		$dmy->shortcut_url=$urlrandom;
		          		$dmy->count_click=1;
		          		$dmy->date_month=$dateM;
		          		$dmy->save();
		          } 
		          /*end date month year statictis*/
					
		}
		return view('getreallink',['inforurl'=>$inforurl]);
	}
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
			$links->job_id=(string)$request->job_id;
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
				$whatIWant=(int)getJobid($defaultLink);
				 //cap nhat vao table jobid
				$job=List_job_id::where('job_id',$whatIWant);
				if($job->count()==0 && $whatIWant!="")//chua co trong table
				{
					$jobid= new List_job_id;
					$jobid->job_id=(int)$whatIWant;
					$jobid->save();

				}
				if($whatIWant!="")
				{
					$links->job_id=(string)$whatIWant;
				}
				else
				{
					$links->job_id= "N/A";
				}
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
		$links->category_id=(int)$request->category;
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
			$links->job_id=(string)$request->job_id;
			//cat ra luu vao list_job_ids
			$jobid=explode( ',' , $request->job_id);
			foreach($jobid as $id)
			{
				$job=List_job_id::where('job_id',$id);
				if($job->count()==0 && $id!="")//chua co trong table
				{
					$jobid= new List_job_id;
					$jobid->job_id=$id;
					$jobid->save();

				}
			}
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
						  $links->category_id=(int)$request->category;
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
							$links->job_id=(string)$request->job_id;
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
		return view('statictis',['danhsach'=>$danhsach,'job_id'=>$listjob,'count'=>$count]);
	}
	public function getStatictisadmin($id)
	{

		$listjob=List_job_id::all();
		$id=(int)$id;
		$danhsachid=Shortcut_url::where('iduser_create',$id)->orderBy('created_at','DESC')->paginate(10);
		$count=$danhsachid->count();
		return view('statictis',['danhsach'=>$danhsachid,'job_id'=>$listjob,'count'=>$count]);
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
		return view('statictis_seeder',['job_id'=>$listjob,'danhsach'=>$danhsach,'count'=>$count]);
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
		$count=count($track);
		$category =Category::all();
		return view('trackcampaign',['track'=>$track,'category'=>$category,'count'=>$count]);
	}
	public function affiliateTrack()
	{
		$track1 =Shortcut_url::where('wait_check',1)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
		$user=User::all();
		return view('affiliatetrack',['track1'=>$track1,'user'=>$user]);
		
	}
}
