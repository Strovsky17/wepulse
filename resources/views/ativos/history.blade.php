@extends('page')
@extends('misc.sidebar', [ "page" => "history", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.history')])

@section('content')

<div class='panel form row panel-history'>

<div class='panel-header'>
        <h2>{!!__("register.history")!!}</h2>

        <button class='btn btn-primary' rule='save' action='save'><i class="fa-light fa-bars-filter"></i></button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required>
        </div>
    </div>
    <div class='table'>
    <script>
        window.addEventListener('load', () => {
            window.pHistory = new PanelHistory( document.querySelector('.panel-history'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: [
                    { id:1, equipment:'Ana Fernandes', category: '+999 999 999 999', register: 'anafernandes@gmail.com', date: 'Administrador' },
                ]
            });
        })
    </script>
    </div>
</div>

@endsection