@extends('page')
@extends('misc.sidebar', [ "page" => "edit", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.customFields')])

@section('content')

   @include('ativos/edit/edit-add')
   @include('ativos/edit/edit-list')
   
@endsection