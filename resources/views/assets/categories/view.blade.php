@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "categories" ])
@extends('misc.topbar', ["title" => __('menu.category')])

@section('content')
    @include('assets/categories/list')
    @include('assets/categories/category')
@endsection