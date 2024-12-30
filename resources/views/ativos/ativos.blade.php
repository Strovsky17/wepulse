@extends('page')
@extends('misc.sidebar', [ "page" => "ativos", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.ativos')])

@section('content')

<div class='panel form row panel-ativos'>
    <div class='panel-header'>
        <h2>{!!__("register.userActives")!!}</h2>

        <button class='btn btn-primary' rule='add' action='save'>  <i class="fa-thin fa-plus"></i> {{ __("form.add") }}</button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("register.search") !!}' required>
        </div>
    </div>
    <div class='table'></div>
    <script>
        window.addEventListener('load', () => {
            window.pAtivo = new PanelAtivo( document.querySelector('.panel-ativo'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: [
                    { id:1, equipment:'Ana Fernandes', category: '+999 999 999 999', risk: 'anafernandes@gmail.com', responsable: 'Administrador', alerts: 'sem alertas' },
                ]
            });
        })
    </script>
</div>
@endsection