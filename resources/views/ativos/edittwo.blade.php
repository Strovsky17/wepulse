<div class='panel form row panel-geraledit-edittwo'>

    <div class='panel-header'>
        <h2>{!!__("menu.customFields")!!}</h2>

        <button class='btn btn-primary' rule='save' action='save'><i class="fa-light fa-bars-filter"></i></button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required>
        </div>
    </div>
    
    <div class='table'></div>
    
    <script>
        window.addEventListener('load', () => {
            window.pUsers = new PanelUsers( document.querySelector('.panel-geraledit-edittwo'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: [
                    { id:1, designation: '+999 999 999 999', values: 'anafernandes@gmail.com', date: 'Administrador' },
                    { id:2, designation: '+999 999 999 999', values: 'anafernandes@gmail.com', date: 'Administrador' },
                    { id:3, designation: '+999 999 999 999', values: 'anafernandes@gmail.com', date: 'Administrador' },
                ]
            });
        })
    </script>
</div>