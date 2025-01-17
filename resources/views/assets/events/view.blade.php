@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "events" ])
@extends('misc.topbar', ["title" => __('menu.assets')])

@section('content')
    @include('assets/events/list')
    @include('assets/events/event')
@endsection