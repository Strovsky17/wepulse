@extends('page')
@extends('misc.sidebar', [ "page" => "register", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.ativos')])

@section('content')

   @include('ativos/register')
   @include('ativos/registertwo')
   
@endsection