@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "category" ])
@extends('misc.topbar', ["title" => __('menu.category')])

@section('content')
    @include('assets/category/list')
    @include('assets/category/category')
@endsection