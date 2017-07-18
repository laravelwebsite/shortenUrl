<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shortcut_url;
use App\Messager;
use App\User;
use File;
use Carbon\Carbon;
class AjaxController extends Controller
{
    public function getMessagercontent(Request $request)
    {
    	
    	if($request->ajax()){
            $id = (int)$request->id;
            $info = Messager::find($id);
            return response()->json($info);
        }
    }
    public function adduser(Request $request)
    {
        if($request->ajax())
        {
            
        }
    }
    public function deleteUrl(Request $request)
    {
        if($request->ajax())
        {

            $id = (int)$request->id;
            $info = Shortcut_url::find($id);
            //trong truong hop mot url co nhieu seeder thi khong nen xoa hinh vi xoa thi mat hinh cua cac row khac
            $count=0;
            $allURL=Shortcut_url::all();
            foreach($allURL as $all)
            {
                if($all->fileupload_name==$info->fileupload_name) $count++;
            }
            //count <=1 la chi co duy nhat url dang xoa co su dung hinh anh nay,xoa
            if($count<=1)
            {
                $folderHinhanh="upload/imagesupload/".$info->fileupload_name;
                if(file_exists($folderHinhanh))
                {
                    File::delete($folderHinhanh);
                }
            }
            $response=$info->delete();
        }
    }
    public function ListCheck(Request $request)
    {
        if(Auth::user()->role_id==1){
            if($request->ajax()){
                $idurl=(int)$request->idSeeder;
                $infor=Shortcut_url::find($idurl);
                if($infor->count() > 0){
                    $html = "";
                    if(isset($infor->id_user_seeder)){

                        $userSeeders = User::where('role_id',0)->get();
                        foreach ($userSeeders as $user){
                            if($user->id== $infor->id_user_seeder) $checked = "checked";
                            else $checked = "";
                            $html .= '<label class="checkbox-inline no-padding-left"><input type="checkbox" name="idSeeder[]" id="idSeeder" value="'.$user->id.'" '.$checked.'>'.$user->name.'</label>';
                        }
                        //$html .='<label class="checkbox-inline no-padding-left"><input type="checkbox" id="allCheckbox"> All [seeders]</label>';
                        $res = ['status' => 'success', 'data' => $html];
                        return json_encode($res);
                    }

                }
            }
        }
    }

    public function UpContSeeder(Request $request)
    {
        if($request->ajax())
        {
            $idurl=(int)$request->idListWaitCheck;
            $inforurl=Shortcut_url::find($idurl);
            if($request->idSeeder)
            {
                if($inforurl->id_user_seeder==-1 || $inforurl->id_user_seeder=="" || $inforurl->id_user_seeder=="null")
                {
                    foreach($request->idSeeder as $iduser)
                    {
                        $links=new Shortcut_url;
                        $idlinkss=Shortcut_url::max('id');
                        $id=$idlinkss+1;
                        $links->id=$id;
                        $links->shortcut_url=$inforurl->shortcut_url;
                        $links->category=$inforurl->category;
                        $links->purpose=$inforurl->purpose;
                        $links->iduser_create=Auth::user()->id;
                        $links->email_user   = Auth::user()->email;
                        $links->wait_check=1;
                                $links->count_click=0;//count
                                $links->source=0;
                                $links->job_id=$inforurl->job_id;
                                $links->redirect= $inforurl->redirect;
                                $links->fileupload_name=$inforurl->fileupload_name;
                                $links->title=$inforurl->title;
                                $links->region = $inforurl->region;
                                $links->description=$inforurl->description;
                                //$links->id_user_seeder=(array)$request->seeder_id;
                                $links->date_begin_seeder=$inforurl->date_begin_seeder;
                                $links->id_user_seeder=$iduser;
                                $links->save();
                            }

                    //xoa hinh 
                            $count=0;
                            $allURL=Shortcut_url::all();
                            foreach($allURL as $all)
                            {
                                if($all->fileupload_name==$inforurl->fileupload_name) $count++;
                            }
                    //count <=1 la chi co duy nhat url dang xoa co su dung hinh anh nay,xoa
                            if($count<=1)
                            {
                                $folderHinhanh="upload/imagesupload/".$inforurl->fileupload_name;
                                if(file_exists($folderHinhanh))
                                {
                                    File::delete($folderHinhanh);
                                }
                            }
                            $inforurl->delete();

                        }
                        else
                        {
                            foreach($request->idSeeder as $iduser)
                            {
                        //neeu co san roi thi update
                                if($iduser==$inforurl->id_user_seeder)
                                {
                                    $inforurl->wait_check=1;
                                    $inforurl->save();
                                }
                            //khong thi them vao voi wait_check=1
                                else
                                {
                                    $links=new Shortcut_url;
                                    $idlinkss=Shortcut_url::max('id');
                                    $id=$idlinkss+1;
                                    $links->id=$id;
                                    $links->shortcut_url=$inforurl->shortcut_url;
                                    $links->category=$inforurl->category;
                                    $links->purpose=$inforurl->purpose;
                                    $links->iduser_create=Auth::user()->id;
                                    $links->email_user   = Auth::user()->email;
                                    $links->wait_check=1;
                                $links->count_click=0;//count
                                $links->source=0;
                                $links->job_id=$inforurl->job_id;
                                $links->redirect= $inforurl->redirect;
                                $links->fileupload_name=$inforurl->fileupload_name;
                                $links->title=$inforurl->title;
                                $links->region = $inforurl->region;
                                $links->description=$inforurl->description;
                                //$links->id_user_seeder=(array)$request->seeder_id;
                                $links->date_begin_seeder=$inforurl->date_begin_seeder;
                                $links->id_user_seeder=$iduser;
                                $links->save();
                            }
                        }
                    }

                }
            }

        }


        public function searchwithjob(Request $request)
        {

            if($request->ajax())
            {
                $key=(int)$request->key;
                $key1=$request->key1;
            //neu la nhap vao la so hoac khong nhap gi
                if(is_numeric($key) || $request->key=="")
                {
                //co nhap vao id
                    if(is_numeric($key))
                    {
                        if($key1=="All")
                        {
                            $urlajax=Shortcut_url::where('job_id',$key)->where('wait_check',1)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
                        }
                        else
                        {
                            
                            $urlajax=Shortcut_url::where('job_id',$key)->where('category_id',$key1)->where('wait_check',1)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
                        }
                    }
                //khong nhap gi
                    if($key=="")
                    {
                        if($key1=="All")
                        {
                            $urlajax=Shortcut_url::where('wait_check',1)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
                        }
                        else
                        {
                            $urlajax=Shortcut_url::where('wait_check',1)->where('category_id',$key1)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
                        }
                    }
                    $urlajax->withPath('admin/trackCampaign');
                    $stt = 1;
                    if(count($urlajax)>0)
                    {
                        echo '
                        <section class="panel">
                          <header class="panel-heading">Tracking campaign</header>
                          <div class="panel-body">
                            <table class="table table-hover display table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th class="text-center">JobID</th>
                                  <th class="text-center"><i class="fa fa-user"></i></th>
                                  <th><i class="fa fa-link"></i> Link rút gọn</th>
                                  <th><i class="fa fa-list"></i> Category</th>
                                  <th class="text-center"><i class="fa fa-calendar"></i><!-- Date tạo --></th>
                                  <th class="text-center">BeginSeeder</th>
                                  <th class="text-center"><i class="fa fa-bar-chart-o"></i> </th>
                                  <th class="text-center"><i class="fa fa-check-square"></i> </th>
                                  <th><i class="fa fa-sticky-note"></i> Region</th>
                                  <th><i class="fa fa-sticky-note"></i> Note</th>
                                  <th class="text-center" style="width: 70px;"><i class="fa fa-edit"></i> </th>
                              </tr>
                          </thead>
                          <tbody>';

                            foreach($urlajax as $tr){
                                $shorturl= $_SERVER['SERVER_NAME'].$tr->shortcut_url;
                                echo
                                '<tr>
                                <td><span>'.$stt++.'</span></td>
                                <td><span>'.$tr->job_id.'</span></td>
                                <td><span';
                                  if($tr->email_user == 'Applancer') echo $tr->email_user ;
                                  else echo ' style="color:red;"';
                                  echo '>';
                                  if(strlen($tr->user->name))  echo $tr->user->name;
                                  else echo "Applancer";

                                  echo '</span></td>
                                  <td><p><a href="'.$tr->redirect.'" title="'.$tr->redirect.'">'.$shorturl.'</a></p></td>
                                  <td><span>'.$tr->category.'</span></td>
                                  <td><span>'.$tr->created_at->format('d-m-Y').'</span></td>
                                  <td><span>'.$tr->date_begin_seeder.'</span></td>
                                  <td class="text-center">
                                    <a href="admin/statictis-details/'.$tr->shortcut_url.'" ><span class="label label-primary label-mini tooltips" data-placement="top" data-original-title="Xem thống kê chi tiết lượt click.">'.$tr->count_click.'</span></a>
                                </td>
                                <td class="text-center">';

                                    if(isset($tr->job_id) && is_numeric($tr->job_id)){
                                        echo 
                                        '<span class="text-center label label-success label-mini tooltips" data-placement="top" data-original-title="Apply" style="display:inline-block;">
                                        <small class="countApply res-'.$tr->shortcut_url.'" idUser="'.$tr->user->id.'" job-id="'.$tr->job_id.'" shortcut_url="'.$tr->shortcut_url.'">
                                            <img src="style-shorten/img/input-spinner.gif">
                                        </small>
                                    </span>';
                                }

                                echo
                                '</td>
                                <td><span>';
                                  if($tr->region=="") 
                                    echo "N/A";
                                else echo  $tr->region;
                                echo 
                                '</span></td>
                                <td><span>';
                                  if($tr->purpose=="") 
                                    echo "Nothing";
                                else echo  $tr->purpose;
                                echo '</span></td>
                                <td class="text-center">
                                    <a class="btn btn-danger btn-xs tooltips btn-del-record" id="'.$tr->id.'" data-toggle="modal" data-placement="top" data-original-title="Delete record." href="#recordDel"><i class="fa fa-trash-o "></i></a>
                                </td>
                            </tr>';

                            
                        }
                       echo '</tbody>
                            </table>
                            <div class="row-fluid">
                              <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="dataTables_info">
                                <p></p><ul><li>'.count($urlajax) .' results</li></ul><p></p>
                                </div>
                              </div>
                              <div class="col-sm-9 col-md-9 col-lg-9">
                                
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                  <ul>
                                    '.$urlajax->links().'
                                  </ul>
                                </div>  
                              </div>
                            </div>
                        </section>';
                    }
                    else
                    {
                        echo "notfound";
                    }

                }
                else
                {

                    echo "fail";
                }
            }
        }

        public function searchwithjobAffiate(Request $request)
        {
            if($request->ajax())
            {
                $jobid=(int)$request->job;
                $datefrom="";
                $dateto="";
                $emailsearch=$request->emailsearch;
                
                $user=User::where('email',$emailsearch)->first();
                if($request->datefrom)
                {
                    $datefrom=new Carbon($request->datefrom);
                }
                if($request->dateto)
                {
                    $dateto=new Carbon($request->dateto);
                }
                
                if(is_numeric($jobid) || $jobid=="")
                {
                    if($jobid=="")
                    {
                        if($datefrom=="")
                        {
                            if($dateto=="")
                            {
                                if($emailsearch=="All")
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                else
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('iduser_create',$user->id)->where('source',0)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                
                            }
                            else
                            {
                                if($emailsearch=="All")
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('source',0)->where('created_at','<=',$dateto)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                else
                                {
                                    $data=Shortcut_url::where('wait_check',1)->where('iduser_create',$user->id)->where('source',0)->where('created_at','<=',$dateto)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                
                            }
                        }
                        else
                        {
                            if($dateto=="")
                            {
                                if($emailsearch=="All")
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('source',0)->where('created_at','>=',$datefrom)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                else
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('iduser_create',$user->id)->where('source',0)->where('created_at','>=',$datefrom)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                
                            }
                            else
                            {
                                if($emailsearch=="All")
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('source',0)->where('created_at','>=',$datefrom)->where('created_at','<=',$dateto)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                else
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('iduser_create',$user->id)->where('source',0)->where('created_at','>=',$datefrom)->where('created_at','<=',$dateto)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                
                            }
                        }
                    }
                    else
                    {

                       if($datefrom=="")
                        {
                            if($dateto=="")
                            {
                                if($emailsearch=="All")
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('source',0)->where('job_id',$jobid)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                else
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('iduser_create',$user->id)->where('source',0)->where('job_id',$jobid)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                
                            }
                            else
                            {
                                if($emailsearch=="All")
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('source',0)->where('job_id',$jobid)->where('created_at','<=',$dateto)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                else
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('iduser_create',$user->id)->where('source',0)->where('job_id',$jobid)->where('created_at','<=',$dateto)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                
                            }
                        }
                        else
                        {

                            if($dateto=="")
                            {
                                if($emailsearch=="All")
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('source',0)->where('job_id',$jobid)->where('created_at','>=',$datefrom)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                else
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('iduser_create',$user->id)->where('source',0)->where('job_id',$jobid)->where('created_at','>=',$datefrom)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                
                            }
                            else
                            {
                                if($emailsearch=="All")
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('source',0)->where('job_id',$jobid)->where('created_at','>=',$datefrom)->where('created_at','<=',$dateto)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                else
                                {
                                        $data=Shortcut_url::where('wait_check',1)->where('iduser_create',$user->id)->where('source',0)->where('job_id',$jobid)->where('created_at','>=',$datefrom)->where('created_at','<=',$dateto)->orderBy('updated_at','DESC')->paginate(10);
                                }
                                
                            }
                        }
                    }
                    if(Auth::user()->role_id==1)
                    {
                        $data->withPath('admin/affiliate-Track');
                    }
                    else
                    {
                        $data->withPath('subadmin/affiliate-Track');
                    }
                    $stt = 1;
                    if(count($data)>0)
                    {
                        echo '<section class="panel">
                          <header class="panel-heading">Affiliate Track list</header>
                          <div class="panel-body">
                            <table class="table table-hover display table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th><i class="fa fa-bookmark"></i> Job ID</th>
                                  <th><i class="fa fa-user"></i> Người tạo</th>
                                  <th><i class=" fa fa-link"></i> Link rút gọn</th>
                                  <th><i class="fa fa-calendar"></i> Ngày/Giờ tạo</th>
                                  <!-- <th><i class=" fa fa-calendar"></i> Ngày bắt đầu seeder</th> -->
                                  <th><i class="fa fa-bar-chart-o"></i> Thống kê</th>
                                  <th><i class=" fa fa-check-square"></i> Aplly</th>
                                  <!-- <th><i class=" fa fa-edit"></i> </th> -->
                                </tr>
                              </thead>
                              <tbody>';
                        $stt = 1;
                      foreach($data as $dt)
                      {
                        $shorturl= $_SERVER['SERVER_NAME'].$dt->shortcut_url;
                        echo '<tr>
                          <td><span>'.$stt++.'</span></td>
                          <td><span>'.$dt->job_id.'</span></td>
                          <td><span>'.$dt->user->email.'</span></td>
                          <td><p><a href="'.$dt->redirect.'">'.$shorturl.'</a></p></td>
                          <td><span>'.$dt->created_at->format('d-m-Y H:s:i').'</span></td>
                        
                          <td class="text-center">
                            
                            <a href="admin/statictis-details/'.$dt->shortcut_url.'" ><span class="label label-primary label-mini tooltips" data-placement="top" data-original-title="Xem thống kê chi tiết lượt click.">'.$dt->count_click.'</span></a>
                          </td>
                          <td class="text-center">';
                          $pareUrl = parse_url($dt->redirect);
                            if($pareUrl['host'] == 'topdev.vn') {
                              $job_id = $dt->job_id;
                              $email  = $dt->user_create;
                              if(is_numeric($job_id) && isset($email)) {
                                echo '<span class="label label-success label-mini text-center" style="display:inline-block;">';
                                echo '<small class="countApply res-'.$dt->shortcut_url.'" email="'.$email.'" job-id="'.$dt->job_id.'" shortcut_url="'.$dt->shortcut_url.'">
                                        <img src="style-shorten/img/input-spinner.gif">
                                      </small>';
                                echo '</span>';
                              }
                            }
                            echo '</td>
                              <!-- <td><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></td> -->
                            </tr>';
                      }
                     echo '</tbody>
                </table>
                <div class="row-fluid">
                  <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="dataTables_info">
                    <p></p><ul><li>'.$data->count() .' results</li></ul><p></p>
                    </div>
                  </div>
                  <div class="col-sm-9 col-md-9 col-lg-9">
      
                    <div class="dataTables_paginate paging_bootstrap pagination">
                      <ul>
                        '.$data->links().'
                      </ul>
                    </div>
                  
                  </div>
                </div>
              </div>
            </section>'  ;

                    }
                    else
                    {
                        echo "notfound";
                    }
                }
                else
                {
                    echo "fail";
                }
            }
        }


    }
