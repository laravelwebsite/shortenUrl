@extends('layout.index')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 col-md-offset-2">
      @if(!Auth::user())
        @include('pages.login')
        @else
                @include('pages.taolink')
      @endif
    </div>
  </div>
</div>
@endsection