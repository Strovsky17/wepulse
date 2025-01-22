@extends('page')
@extends('misc.sidebar', [ "page" => "assets", "subpage" => "assets" ])
@extends('misc.topbar', ["title" => __('menu.assets')])

@section('content')
<div class='panel form row panel-assets'>

    <div class='panel-header' >
        <h2>{!!__("menu.assets")!!}</h2>
    </div>

    <div class='form'>
    <div class='form-header'>
            @if( auth()->user()->role == 'superadmin' || auth()->user()->roleClient == 'admin' )
            <button class='btn btn-primary' action='add'><i class="fa-thin fa-plus"></i> {{ __("form.add") }}</button>
            @endif

            <div class='search form-group'>
                <i class="fa-solid fa-magnifying-glass"> </i>
                <input type="text" class='' name='search' placeholder='{!! __("profile.search") !!}' required />
            </div>
    </div>
    <div class='table'></div>
    </div>

    <script>
        window.addEventListener('load', () => {
            new PanelAssets( document.querySelector('.panel-assets'), {
                data: {!! json_encode($assets) !!},
                categories: {!! json_encode($categories) !!},
                responsables: {!! json_encode($responsables) !!},
            });
        })
    </script>
</div>
@endsection