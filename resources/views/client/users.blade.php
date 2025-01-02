<div class='panel form row panel-profile-users'>

    <div class='panel-header'>
        <h2>{!!__("profile.userUsers")!!}</h2>

        <button class='btn btn-primary' action='save'><i class="fa-thin fa-plus"></i> {{ __("form.add") }}</button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required />
        </div>
    </div>

    <div class='table'></div>

    <script>
        window.addEventListener('load', () => {
            window.pUsers = new PanelUsers( document.querySelector('.panel-profile-users'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: [
                    { id:1, name:'Ana Fernandes', phone: '+999 999 999 999', email: 'anafernandes@gmail.com', role: 'Administrador' },
                    { id:2, name:'Francisco Rodrigues', phone: '+999 999 999 999', email: 'francisco@gmail.com', role: 'Administrador' },
                    { id:3, name:'João Gonçalves', phone: '+999 999 999 999', email: 'joao@gmail.com', role: 'Administrador' },
                    { id:4, name:'Ana Fernandes', phone: '+999 999 999 999', email: 'anafernandes@gmail.com', role: 'Administrador' },
                ]
            });
        })
    </script>
</div>