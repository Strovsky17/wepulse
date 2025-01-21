@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "asset" ])
@extends('misc.topbar', ["title" => __('menu.assets')])

@section('content')
    @include('assets/assets/asset')
    @include('assets/events/list')
    @include('assets/events/event')
    @include('assets/alerts/list')
    @include('assets/alerts/alert')
@endsection