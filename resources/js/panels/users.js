import axios from "axios";

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

        _this.parameters.__edit = 0;
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
                let data = {
                    name: _this.parameters.__name,
                    nif: _this.parameters.__nif,
                    address: _this.parameters.__address,
                    zipcode: _this.parameters.__zipcode,
                    locality: _this.parameters.__locality,
                    contact: _this.parameters.__contact,
                    email: _this.parameters.__email,
                }

                axios.post('profile', data).then( ()=> {
                    _this.parameters.__edit = 0;
                }).catch(() => {
                    console.lof('FALTA - toast Error');
                })   
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

    this.actions = {
        add: () => {
            window.pUserAdd.open( null,  _this.addUser);
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
    this.addUser = (user) => {

        let data = _this.table.config.data;
        for (let i = 0; i < data.length; i++) 
        {
            const u = data[i];
            if( u.id == user.id )
            {
                data[i] = user;
                _this.table.search();
                return true;
            }
        }

    // Remove Client to database
    this.removeList = (id) => {

        let aux = [];
        let data = _this.table.config.data;
        for (let i = 0; i < data.length; i++) 
        {
            const f = data[i];
            if( f.id != id )
                aux.push(data[i]);
        }

        _this.table.config.data = aux;
        _this.table.search();
    }

        _this.table.config.data.push(user);
        _this.table.search();
    }

    // Initialize table
    this.initTable = () => {

        this.table = new SuperTable( document.querySelector('.table'),{
            rowsPerPage: 10,
            perPage: false,
            search: false,
            columns: {
                name: window.tableLang.name,
                phone: window.tableLang.phone,
                email: window.tableLang.email,
                roleClient: window.tableLang.role,
            },
            data: __config.data,
            actions:[
                { 'cls':'primary', 'icon':'thin fa-pen-to-square', label: '', callback: (d) => { 

                    window.pUserAdd.open(d, (user) => {
                        _this.addUser(user);
                    });
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => {
                    window.WepulseModal( 'confirm', ( flag ) => {
                        if( flag == true )
                        {
                            axios.delete( 'client/userAdd'+d.id ).then( (response) => {
                                _this.removeList(d.id);
                            }).catch(() => {

                            });
                        }
                    });

                }},
            ]
        });

    }

    _this._construtor();
}

// The to add User to a Client
window.PanelUserAdd = function( $scope )
{
    let _this = this;
    this.$scope = $scope;

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
                
                axios.post( '/user', { 
                    name: _this.parameters.__name,
                    phone: _this.parameters.__phone, 
                    email: _this.parameters.__email, 
                    role: _this.parameters.__role,
                    password: _this.parameters.__password,
                } )
                .then( ( r ) => {
                    if( _this.successCallBack != undefined )
                        _this.successCallBack( r.data );

                    _this.close();
                    _this.parameters.__load = 0;
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

    this.openDisplay = ( data ) => {


        console.log(data);

        _this.parameters.__name = '';
        _this.parameters.__phone = '';
        _this.parameters.__email = '';
        _this.parameters.__password = '';
        _this.parameters.__role ='';
        _this.parameters.__load = 0;
    }

    _this._construtor();
}

