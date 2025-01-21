<div class='panel form row panel-client-list'>

    <div class='panel-header'>
        <h2>{!!__("menu.client")!!}</h2>
    </div>

    <div class='form'>
    <div class='form-header'>
            <button class='btn btn-primary' action='add'> <i class="fa-thin fa-plus"></i> {{ __("form.add") }}</button>

            <div class='search form-group'>
                <i class="fa-solid fa-magnifying-glass"> </i>
                <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required />
            </div>
    </div>
    <div class='table'></div>
    </div>

    <script>
        window.addEventListener('load', () => {
            window.pUsers = new PanelClients( document.querySelector('.panel-client-list'), {
                data: {!! json_encode($clients) !!}
            });
        })
    </script>
</div>