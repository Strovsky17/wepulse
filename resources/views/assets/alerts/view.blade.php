@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "alerts" ])
@extends('misc.topbar', ["title" => __('menu.assets')])

@section('content')
    @include('assets/alerts/list')
    @include('assets/alerts/alert')
@endsection