@extends('page')
@extends('misc.sidebar', [ "page" => "register", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.ativos')])

@section('content')

   @include('ativos/register/register-register')
   @include('ativos/register/register-maintenance')
   @include('ativos/register/register-label')
   
@endsection