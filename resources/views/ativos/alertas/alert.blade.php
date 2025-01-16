@extends('page')
@extends('misc.sidebar', [ "page" => "alerts", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.alerts')])

@section('content')

   @include('ativos/alerts/alert-create')
   @include('ativos/alerts/alert-list')
   
@endsection