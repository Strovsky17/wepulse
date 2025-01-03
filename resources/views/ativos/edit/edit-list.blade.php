<div class='panel form row panel-geraledit-edittwo'>

    <div class='panel-header'>
        <h2>{!!__("menu.customFields")!!}</h2>

        <button class='btn1' action='save'><i class="fa-light fa-bars-filter"></i></button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required>
        </div>
    </div>
    
    <div class='table'></div>
    
    <script>
        window.addEventListener('load', () => {
            window.pUsers = new PanelEdit( document.querySelector('.panel-geraledit-edittwo'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: [
                    { id:1, designation: 'Firewalls', values: 'Rede e Segurança', date: '10/10/2024' },
                    { id:2, designation: 'Autenticação Multifatorial', values: 'Identidade e Acesso', date: '10/10/2024' },
                    { id:3, designation: 'DLP', values: 'Proteção de Dados', date: '10/10/2024' },
                ]
            });
        })
    </script>
</div>