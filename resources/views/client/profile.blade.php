@extends('page')
@extends('misc.sidebar', [ "page" => "profile", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.profile')])

@section('content')

   @include('client/info')
   @include('client/users')
   
@endsection