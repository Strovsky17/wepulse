@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "category" ])
@extends('misc.topbar', ["title" => __('menu.category')])

@section('content')
    @include('assets/categorys/list')
    @include('assets/categorys/category')
@endsection