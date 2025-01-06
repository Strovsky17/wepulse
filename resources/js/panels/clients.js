import axios from "axios";

// Show user of the BO
window.PanelClients = function( $scope, __config )
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

    this.actions = { 
        add: () => {
            window.pClientAdd.open( null,  _this.addClient);
        }
    }

    this.process = () => {

        if( this.table != null )
        {
            this.table.$search.value = this.parameters.__search;
            this.table.search();
        }
    }

    // Add Client to database
    this.addClient = (newClient) => {

        _this.table.config.data.push(newClient);
        _this.table.search();
    }

    // Initialize table
    this.initTable = () => {

        this.table = new SuperTable( document.querySelector('.table'),{
            rowsPerPage: 10,
            perPage: false,
            search: false,
            columns: {
                id: '#',
                name: window.tableLang.name,
                token: 'Token',
            },
            data: __config.data,
            actions:[
                { 'cls':'primary', 'icon':'thin fa-pen-to-square', label: '', callback: (d) => { 
                    
                    axios.post('client/change', {'token':d.token }).then((response) => {
                        window.location.href = '/';
                    }).catch(() => {

                    });
                }}
                
                /*,
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => { 
                    alert('Remove User') 
                }},*/
            ]
        });

    }

    _this._construtor();
}

// Show user of the BO
window.PanelClientAdd = function( $scope )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );
    }

    this.rules = {
        load: (p) => { return p.__load == 1; }
    }

    this.actions = {
        save: (f) => {
          
            if(f.validate())
            {
                _this.parameters.__load = 1;
                
                axios.post( '/client', { name: _this.parameters.__name } )
                .then( () => {
                    // PEDIDO A API
                    if( _this.successCallBack != undefined )
                        _this.successCallBack( { id:1, name: _this.parameters.__name } );

                    _this.close();
                })
                .catch( () => {
                    console.log('POP UP ERRRO');
                    _this.parameters.__load = 0;
                });
            }
        },
        // cancel
        cancel: () => {
            _this.close();
        }
    }

    this.openDisplay = () => {
        _this.parameters.__name = '';
        _this.parameters.__load = 0;
    }

    _this._construtor();
}