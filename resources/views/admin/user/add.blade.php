 @extends('admin.layout.index')

 @section('content')
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/user/add" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>There were some problems with your input! <br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul> 
                </div>
            @endif

            @if(session('thongbao'))
                    <div class="alert alert-success">
                    <strong>{{session('thongbao')}}</strong>
                </div>
            @endif
            @if(session('loi'))
                    <div class="alert alert-danger">
                    <strong>{{session('loi')}}</strong>
                </div>
            @endif
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Nhập email" />
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Nhập lại Mật khẩu</label>
                        <input type="password" class="form-control" name="repassword" placeholder="Nhập lại mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Chọn quyền</label>
                        <label class="radio-inline" >
                            <input  name="quyen" checked="true" value="0" type="radio">User
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" type="radio">Admin
                        </label>
                        
                    </div>
                    <button type="submit" class="btn btn-default">Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    @endsection