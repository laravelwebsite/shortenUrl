@extends('layout.index')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title" style="margin:50px;font-weight: bold;color: red">Sign Up</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="post" action="dangky">
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
              <label for="name" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group">
              <label for="passwordAgain" class="col-sm-2 control-label">Confirm Password</label>
              <div class="col-sm-10">
                <input type="password" name="passwordAgain" class="form-control" id="passwordAgain" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Sign up</button>
                <a href="/"><button type="button" class="btn btn-danger">Cancel</button></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection