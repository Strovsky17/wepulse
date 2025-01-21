<div class='panel form row panel-assets-table-events d-none'>

    <div class='panel-header {{ !isset($asset) ? "show" : "" }}' action='changeShowHide'>
        <h2>{!!__("menu.events")!!}</h2>
        <i class="fa-sharp-duotone fa-regular fa-chevron-down" rule='mode'></i>
    </div>

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
    <div class='table'></div>
    </div>

    <script>
        window.addEventListener('load', () => {
            window.pAssetTableEvents = new PanelAssetsTableEvents( document.querySelector('.panel-assets-table-events'), {
                asset_mode: {{ isset($asset) ? 1 : 0 }}
            });
        })
    </script>
</div>