// Show Company profile
window.PanelProfile = function( $scope, __config )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );
    }

    this.rules = {
        save: (p) => { return p.__edit == 1; },
        edit: (p) => { return p.__edit == 0; }
    }

    this.actions = {

        edit: (f) => {
            f.parameters.__edit = 1;
        },
        
        save: (f) => {

            if(f.validate())
            {
                f.parameters.__edit = 0;            
            }

        }
    }

    _this._construtor();
}

// Show user of the BO
window.PanelUsers = function( $scope, __config )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );
        this.initTable();
    }

    this.rules = {
        
    }

    this.actions = {
    }

    // Initialize table
    this.initTable = () => {

        new SuperTable( document.querySelector('.table'),{
            rowsPerPage: 10,
            /*lang: {
                create: "{{__('table.create')}}",
                next: "{{__('table.next')}}",
                prev: "{{__('table.prev')}}",
                countPage: "{{__('table.countPage')}}",
                noResults: "{{__('table.noResults')}}",
                search: "{{__('table.search')}}"
            },*/
            columns: {
                name: __config.lang.name,
                phone: __config.lang.phone,
                email: __config.lang.email,
                role: __config.lang.role
            },
            data: __config.data,
            actions:[
                { 'cls':'primary', 'icon':'pencil', label: '', callback: (d) => { console.log('a') } },
                { 'cls':'primary', 'icon':'pencil', label: '', callback: (d) => { console.log('a') } },
            ]
        });

    }

    _this._construtor();
}