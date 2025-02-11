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
                    <i class="fa-light fa-user"></i> {{ __('menu.profile') }}
                </a>
            </div>

            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "assets" ? "active open" : "" }}' >
                    <i class="fa-solid fa-server"></i> {{ __('menu.assets') }}
                </a>
                <div>
                    <a href='/assets/asset' class='{{ $subpage == "register" ? "active" : "" }}' >
                        {{ __('menu.register') }}
                    </a>
                    <a href='/assets' class='{{ $subpage == "assets" ? "active" : "" }}' >
                        {{ __('menu.assets') }}
                    </a>                    
                    <a href='/assets/alerts' class='{{ $subpage == "alerts" ? "active" : "" }}' >
                        {{ __('menu.alerts') }}
                    </a>
                    <a href='/assets/categories' class='{{ $subpage == "categories" ? "active" : "" }}' >
                        {{ __('menu.category') }}
                    </a>
                    <a href='/assets/fields' class='{{ $subpage == "fields" ? "active" : "" }}' >
                        {{ __('menu.personalFields') }}
                    </a>
                    <a href='/assets/events' class='{{ $subpage == "events" ? "active" : "" }}' >
                        {{ __('menu.events') }}
                    </a>
                    <a href='/assets/responsables' class='{{ $subpage == "responsables" ? "active" : "" }}' >
                        {{ __('menu.responsable') }}
                    </a>
                </div>
            </div>

            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }} disabled' >
                    <i class="fa-thin fa-triangle-exclamation"></i> {{ __('menu.incidents') }}
                </a>
                <div>
                    <a href='/incidents' class='{{ $subpage == "incidents" ? "active" : "" }}' >
                        {{ __('menu.incidents') }}
                    </a>
                    <a href='/incidents/registerIncidents' class='{{ $subpage == "registerIncidents" ? "active" : "" }}' >
                        {{ __('menu.registerIncidents') }}
                    </a>
                    <a href='/incidents/problems' class='{{ $subpage == "problems" ? "active" : "" }}' >
                        {{ __('menu.problems') }}
                    </a>
                    <a href='/incidents/reportAnalysis' class='{{ $subpage == "reportAnalysis" ? "active" : "" }}' >
                        {{ __('menu.reportAnalysis') }}
                    </a>
                </div>
            </div>
           
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }} disabled' >
                    <i class="fa-light fa-lock-keyhole"></i> {{ __('menu.securityPolicies') }}
                </a>
                <div>
                    <a href='/securityPolicies/internalPolicies' class='{{ $subpage == "active" ? "active" : "" }}' >
                        {{ __('menu.internalPolicies') }}
                    </a>
                    <a href='/securityPolicies/loadPolicies' class='{{ $subpage == "register" ? "active" : "" }}' >
                        {{ __('menu.loadPolicies') }}
                    </a>
                </div>
            </div>
            
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }} disabled' >
                    <i class="fa-regular fa-chart-mixed"></i> {{ __('menu.risk') }}
                </a>
            </div>

            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }} disabled' >
                    <i class="fa-light fa-file-circle-info"></i> {{ __('menu.comunications') }}
                </a>
            </div>
            
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }} disabled' >
                    <i class="fa-light fa-shield-check"></i> {{ __('menu.securityPlans') }}
                </a>
            </div>
           
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }} disabled' >
                    <i class="fa-light fa-graduation-cap"></i> {{ __('menu.training') }}
                </a>
            </div>
            
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }} disabled' >
                    <i class="fa-regular fa-file-chart-column"></i> {{ __('menu.cncsReports') }}
                </a>
            </div>
           
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }} disabled' >
                    <i class="fa-light fa-box-archive"></i> {{ __('menu.archives') }}
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