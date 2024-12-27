@extends('page')
@extends('misc.sidebar', [ "page" => "edit", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.customFields')])

@section('content')

   @include('ativos/edit')
   @include('ativos/edittwo')
   
@endsection