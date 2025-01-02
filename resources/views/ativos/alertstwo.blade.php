<div class='panel form row panel-geralalerts-alertstwo'>

<div class='panel-header'>
        <h2>{!!__("register.allAlerts")!!}</h2>

        <button class='btn btn-primary' rule='save' action='save'><i class="fa-light fa-bars-filter"></i></button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required>
        </div>
    </div>

    <div class='table'></div>
    <script>
        window.addEventListener('load', () => {
            window.pAtivo = new PanelAlerttwo( document.querySelector('.panel-ativo'), {
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
