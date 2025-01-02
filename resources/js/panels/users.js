// Login
window.PanelLogin = function( $scope, __config )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );
    }

    this.rules = {}

    this.actions = {
        
        login: (f) => {

            if(f.validate())
            {
                axios.post('login',{ email: f.parameters.__email, password: f.parameters.__password }) 
                    .then(() => {
                        window.location.href = '/';
                    })
                    .catch(error => {
                        alert('An error occurred.');
                    });
            }
        }
    }

    _this._construtor();
}

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

        _this.parameters.__search = '';
    }

    this.rules = {
        
    }

    this.actions = { }

    this.process = () => {

        if( this.table != null )
        {
            this.table.$search.value = this.parameters.__search;
            this.table.search();
        }
    }

    // Initialize table
    this.initTable = () => {

        this.table = new SuperTable( document.querySelector('.table'),{
            rowsPerPage: 10,
            perPage: false,
            search: false,
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
                role: __config.lang.role,
            },
            data: __config.data,
            actions:[
                { 'cls':'primary', 'icon':'thin fa-pen-to-square', label: '', callback: (d) => { 
                    alert('Ver User') 
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => { 
                    alert('Remove User') 
                }},
            ]
        });

    }

    _this._construtor();
}