@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "asset" ])
@extends('misc.topbar', ["title" => __('menu.assets')])

@section('content')
    @include('assets/assets/asset')
@endsection