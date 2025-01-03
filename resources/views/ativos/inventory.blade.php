@extends('page')
@extends('misc.sidebar', [ "page" => "inventory", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.inventory')])

@section('content')

@include('ativos/register/register-register')
@include('ativos/history/history-list')

@endsection