@extends('page')
@extends('misc.sidebar', [ "page" => "history", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.history')])

@section('content')

@include('ativos/history/history-list')

@endsection