<div class='panel form row panel-geralalerts-alertstwo'>

<div class='panel-header'>
        <h2>{!!__("register.allAlerts")!!}</h2>

        <button class='btn1' action='save'><i class="fa-light fa-bars-filter"></i></button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required>
        </div>
    </div>

    <div class='table'></div>
    <script>
        window.addEventListener('load', () => {
            window.pAtivo = new PanelAlerts( document.querySelector('.panel-geralalerts-alertstwo'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: [
                    { id:1, type:'Firewalls', active: 'Rede e Segurança', category: 'Rede e Segurança', date:'10/10/2024' },
                    { id:2, type:'Autenticação Multifatorial', active: 'Identidade e Acesso', category: 'Identidade e Acesso', date:'10/10/2024' },
                    { id:3, type:'DLP', active: 'Proteção de Dados', category: 'Proteção de Dados', date:'10/10/2024' },
                ]
            });
        })
    </script>
</div>
