@extends('layout.index')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 col-md-offset-2">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title" style="margin:50px;font-weight: bold;color: red">Type your link here to get short link</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" method="post" action="trangchu/taolink" enctype="multipart/form-data">
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
            @if(session('loi'))
            <div class="alert alert-danger">
              <strong>{{session('loi')}}</strong>
            </div>
            @endif
            @if(session('shortlink'))
            <div class="alert alert-success">
              <strong>Your shortlink:{{session('shortlink')}}</strong>
            </div>
            @endif
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label for="link" class="col-sm-2 control-label">Your link here</label>
              <div class="col-sm-10">
                <input type="text" name="link" class="form-control" id="link" placeholder="Type link here" required>
              </div>
            </div>
            <div class="form-group">
              <input type="checkbox" name="advanced" id="advanced">Click to setting Advanced<br >
              <label for="title" class="col-sm-2 control-label">Title</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control advanced" id="title" placeholder="Type title" required disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="description" class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10">
                <input type="text" name="description" class="form-control advanced" id="description" placeholder="Type description" required disabled="">
              </div>
            </div> 
            <div class="form-group">
              <label for="images" class="col-sm-2 control-label">Images</label>
              <div class="col-sm-10">
                <input type="file" name="images" class="form-control advanced" id="images" placeholder="Type images" required disabled="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Get shortlink</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $('#advanced').change(function(){
    if($(this).is(":checked"))
    {
      $('.advanced').removeAttr('disabled');
    }
    else
    {
     $('.advanced').attr('disabled','');
   }
 });

</script>
@endsection