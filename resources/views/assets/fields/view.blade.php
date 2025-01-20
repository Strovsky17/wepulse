@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "fields" ])
@extends('misc.topbar', ["title" => __('menu.assets')])

@section('content')
    @include('assets/fields/list')
    @include('assets/fields/field')
@endsection