<div class='panel form row panel-profile-users'>

    <div class='panel-header'>
        <h2>{!!__("profile.userUsers")!!}</h2>


        <div class='form'>

            <div class='form-header'>
                @if(  auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin' )
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
            window.pUsers = new PanelUsers( document.querySelector('.panel-profile-users'), {
                lang: {
                    ...{!! json_encode( __('table') )  !!},
                },
                data: {!! json_encode( $users )  !!}
            });
        })
    </script>
</div>