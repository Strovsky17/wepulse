@extends('page')
@extends('misc.sidebar', [ "page" => "client", "subpage" => "responsables" ])
@extends('misc.topbar', ["title" => __('menu.responsables')])

@section('content')
    @include('client/responsables/list')
    @include('client/responsables/responsable')
@endsection