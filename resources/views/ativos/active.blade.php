@extends('page')
@extends('misc.sidebar', [ "page" => "ativos", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.ativos')])

@section('content')

<div class='panel form row panel-ativos'>

<div class='panel-header'>
        <h2>{!!__("register.userActives")!!}</h2>
        <button class='btn1' action='save'><i class="fa-light fa-bars-filter"></i></button>
        <button class='btn1' action='save'><i class="fa-sharp-duotone fa-light fa-arrow-down-to-bracket"></i></i></button>
        <button class='btn btn-primary' action='save'><i class="fa-thin fa-plus"></i> {{ __("form.add") }}</button>


        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("register.search") !!}' required>
        </div>
    </div>

    <div class='table'></div>
    <script>
        window.addEventListener('load', () => {
            window.pAtivo = new PanelActive( document.querySelector('.panel-ativos'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: [
                    { id:1, equipment:'Firewalls', category: 'Rede e Segurança', risk: 'Baixo', responsable: 'João Gonçalves', alerts: 'Sem Alertas' },

                    { id:2, equipment:'Autenticação Multifatorial', category: 'Identidade e Acesso', risk: 'Alto', responsable: 'Francisco Rodrigues', alerts: '2 Alertas' },

                    { id:3, equipment:'DLP', category: 'Proteção de Dados', risk: 'Moderado', responsable: 'Ana Fernandes', alerts: 'Sem Alertas' },

                    { id:4, equipment:'Backup Seguro', category: 'Backup e Recuperação', risk: 'Alto', responsable: 'João Gonçalves', alerts: '1 Alerta' },

                    { id:5, equipment:'Firewalls', category: 'Rede e Segurança', risk: 'Baixo', responsable: 'João Gonçalves', alerts: 'Sem Alertas' },

                    { id:6, equipment:'Autenticação Multifatorial', category: 'Identidade e Acesso', risk: 'Alto', responsable: 'Francisco Rodrigues', alerts: 'Sem Alertas' },

                    { id:7, equipment:'DLP', category: 'Proteção de Dados', risk: 'Moderado', responsable: 'Ana Fernandes', alerts: 'Sem Alertas' },

                    { id:8, equipment:'Backup Seguro', category: 'Backup e Recuperação', risk: 'Alto', responsable: 'João Gonçalves', alerts: 'Sem Alertas' },
                ]
            });
        })
    </script>
</div>
@endsection