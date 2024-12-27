@section('sidebar')
<div class="sidebar">

    <div class='sidebar-container'>
        
        <div class='logo'>
            <img src='/images/logo.png'/>
        </div>

        <div class='user'>
            <div class='image'></div>
            <div class='name'>Layout</div>
        </div>

        <div class="sidebar-menu">

            <div class='menu-link'>
                <a href='/profile' class='{{ $page == "profile" ? "active" : "" }}' >
                    <i class="fa-light fa-user"></i> {{ __('menu.profile') }}
                </a>
            </div>

            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
                    <i class="fa-solid fa-server"></i> {{ __('menu.ativos') }}
                </a>
                <div>
                    <a href='/ativos' class='{{ $subpage == "active" ? "active" : "" }}' >
                        {{ __('menu.ativos') }}
                    </a>
                    <a href='/ativos/register' class='{{ $subpage == "register" ? "active" : "" }}' >
                        {{ __('menu.register') }}
                    </a>
                    <a href='/ativos/alerts' class='{{ $subpage == "alerts" ? "active" : "" }}' >
                        {{ __('menu.alerts') }}
                    </a>
                    <a href='/ativos/inventory' class='{{ $subpage == "inventory" ? "active" : "" }}' >
                        {{ __('menu.inventory') }}
                    </a>
                    <a href='/ativos/history' class='{{ $subpage == "history" ? "active" : "" }}' >
                        {{ __('menu.history') }}
                    </a>
                </div>
            </div>

            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
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
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
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
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
                    <i class="fa-regular fa-chart-mixed"></i> {{ __('menu.risk') }}
                </a>
            </div>

            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
                    <i class="fa-light fa-file-circle-info"></i> {{ __('menu.comunications') }}
                </a>
            </div>
            
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
                    <i class="fa-light fa-shield-check"></i> {{ __('menu.securityPlans') }}
                </a>
            </div>
           
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
                    <i class="fa-light fa-graduation-cap"></i> {{ __('menu.training') }}
                </a>
            </div>
            
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
                    <i class="fa-regular fa-file-chart-column"></i> {{ __('menu.cncsReports') }}
                </a>
            </div>
           
            <div class='menu-link'>
                <a href='javascript:void(0)' action='open' class='{{ $page == "" ? "active" : "" }}' >
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