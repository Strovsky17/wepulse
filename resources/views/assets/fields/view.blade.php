@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "fields" ])
@extends('misc.topbar', ["title" => __('menu.events')])

@section('content')
    @include('assets/fields/list')
    @include('assets/fields/field')
@endsection