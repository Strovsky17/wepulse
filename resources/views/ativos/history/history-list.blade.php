<div class='panel form row panel-history'>

<div class='panel-header'>
        <h2>{!!__("register.history")!!}</h2>

        <button class='btn1' action='save'><i class="fa-light fa-bars-filter"></i></button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required>
        </div>
    </div>
    <div class='table'></div>
    <script>
        window.addEventListener('load', () => {
            window.pHistory = new PanelHistory( document.querySelector('.panel-history'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: [
                    { id:1, equipment:'Firewalls', category: 'Rede e Segurança', register:'Manutenção', date:'10/12/2024'},

                    { id:2, equipment:'Autenticação Multifatorial', category: 'Identidade e Acesso', register:'Substituição', date:'10/12/2024'},

                    { id:3, equipment:'DLP', category: 'Proteção de Dados', risk: 'Moderado', register:'Manutenção', date:'10/12/2024'},

                    { id:4, equipment:'Backup Seguro', category: 'Backup e Recuperação', register:'Atualização', date:'10/12/2024'},

                    { id:5, equipment:'Firewalls', category: 'Rede e Segurança', register:'Manutenção', date:'10/12/2024'},

                    { id:6, equipment:'Autenticação Multifatorial', category: 'Identidade e Acesso', register:'Manutenção', date:'10/12/2024'},

                    { id:7, equipment:'DLP', category: 'Proteção de Dados', register:'Substituição', date:'10/12/2024'},

                    { id:8, equipment:'Backup Seguro', category: 'Backup e Recuperação', register:'Atualização', date:'10/12/2024'},
                ]
            });
        })
    </script>
</div>
