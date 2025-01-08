@section('sidebar')
<div class="sidebar">

    <div class='sidebar-container'>
        
        <div class='logo'>
            <img src='/images/logo.png'/>
        </div>

        <div class='user'>
            <div class='image'></div>
            <div class='name'>{{ auth()->user()->name }}</div>
        </div>

        <div class="sidebar-menu">

            <div class='menu-link'>
                <a href='/profile' class='{{ $page == "profile" ? "active" : "" }}' >
                    <i class="fa-light fa-user"></i> {{ __('menu.client') }}
                </a>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            new PanelMenu( document.querySelector('.sidebar') );
        })
    </script>
</div>

@endsection