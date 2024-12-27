@extends('page')
@extends('misc.sidebar', [ "page" => "geral", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.geral')])

@section('content')

   @include('ativos/register')
   @include('ativos/registertwo')
   
@endsection