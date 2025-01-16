@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "histories" ])
@extends('misc.topbar', ["title" => __('menu.history')])

@section('content')
    @include('assets/histories/list')
    @include('assets/histories/history')
@endsection