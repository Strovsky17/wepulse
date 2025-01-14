@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "assets" ])
@extends('misc.topbar', ["title" => __('menu.assets')])

@section('content')
    
    <div class='panel form row panel-assets'>

    <div class='panel-header'>
        <h2>{!!__("menu.register")!!}</h2>

        @if( auth()->user()->role == 'superadmin' || auth()->user()->roleClient == 'admin' )
        <button class='btn btn-primary' action='add'><i class="fa-thin fa-plus"></i> {{ __("form.add") }}</button>
        @endif

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class='' name='search' placeholder='{!! __("profile.search") !!}' required />
        </div>
    </div>

    <div class='table'></div>

    <script>
        window.addEventListener('load', () => {
            new PanelAssets( document.querySelector('.panel-assets'), {
                data: {!! json_encode($assets) !!}
            });
        })
    </script>
    </div>

@endsection