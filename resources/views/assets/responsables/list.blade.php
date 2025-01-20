<div class='panel form row panel-assets-table-responsable'>

    <div class='panel-header'>
        <h2>{!!__("menu.responsable")!!}</h2>



        <div class='form'>

            <div class='form-header'>

                @if( auth()->user()->role == 'superadmin' || auth()->user()->roleClient == 'admin' )
                <button class='btn btn-primary' action='add'><i class="fa-thin fa-plus"></i> {{ __("form.add") }}</button>
                @endif

                <div class='search form-group'>
                    <i class="fa-solid fa-magnifying-glass"> </i>
                    <input type="text" class='' name='search' placeholder='{!! __("profile.search") !!}' required />
                </div>
            </div>
        </div>
</div>

    <div class='table'></div>

    <script>
        window.addEventListener('load', () => {
            new PanelAssetsTableResponsable( document.querySelector('.panel-assets-table-responsable'), {
                data: {!! json_encode($responsables) !!}
            });
        })
    </script>
</div>