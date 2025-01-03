@extends('page')
@extends('misc.sidebarAdmin', [ "page" => "profile", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.client')])

@section('content')

    @include('admin/list')
    @include('admin/add')      
   
@endsection