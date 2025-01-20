@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "responsables" ])
@extends('misc.topbar', ["title" => __('menu.assets')])

@section('content')
    @include('assets/responsables/list')
    @include('assets/responsables/responsable')
@endsection