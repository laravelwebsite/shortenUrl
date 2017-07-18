<div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title" style="margin:50px;font-weight: bold;color: red">Login to use.........please!!</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="post" action="dangnhap">
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
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Sign in</button>
                <a href="dangky"><button type="button" class="btn btn-success">Sign up</button></a>
              </div>
            </div>
          </form>
        </div>
      </div>