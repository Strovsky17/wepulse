import axios from "axios";

// Show user of the BO
window.PanelAssetsTableFields = function( $scope, __config )
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

    this.rules = {}

    this.actions = {
        add: () => {
            window.pAssetsField.open( null,  _this.processList );
        },
    }

    this.process = () => {

        if( this.table != null )
        {
            this.table.$search.value = this.parameters.__search;
            this.table.search();
        }
    }

    // Add Client to database
    this.processList = (field) => {

        let data = _this.table.config.data;
        for (let i = 0; i < data.length; i++) 
        {
            const f = data[i];
            if( f.id == field.id )
            {
                data[i] = field;
                _this.table.search();
                return true;
            }
        }

        _this.table.config.data.push(field);
        _this.table.search();
    }
    
    // Add Client to database
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

    // Initialize table
    this.initTable = () => {

        this.table = new SuperTable( document.querySelector('.table'),{
            rowsPerPage: 10,
            perPage: false,
            search: false,
            columns: {
                name: window.tableLang.name,
                type: `<div class="text-center">${window.tableLang.type}</div>`,
                required: '<div class="text-center">Required</div>',
            },
            data: __config.data,
            process_value_required: (v) => {
                if(v == true)
                    return '<div class="text-center"><i class="fa-regular fa-square-check"></i></div>';
                else
                    return '<div class="text-center"><i class="fa-regular fa-square-xmark"></i></div>';
            },
            process_value_type: (v) => {
                return `<div class="text-center">${v}</div>`;
            },
            actions:[
                { 'cls':'primary', 'icon':'thin fa-pen-to-square', label: '', callback: (d) => { 
                    window.pAssetsField.open( d,  _this.processList );
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => {
                    window.WepulseModal( 'confirm', ( flag ) => {
                        if( flag == true )
                        {
                            axios.delete( 'assets/field/'+d.id ).then( (response) => {
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

// Show user of the BO
window.PanelAssetsField = function( $scope )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );
    }

    // Rules
    this.rules = {
        needValues: (p) => { return p.__type == 'checkbox' || p.__type == 'radiobutton' || p.__type == 'dropdown'  },
        load: (p) => { return p.__load == '1'  }
    }

    // Actions
    this.actions = {
        // Add Field Value
        add: () => {
            _this.addFieldValue();
        },
        // Remove Field Value
        remove: (f, $el) => {

            $el.parentNode.remove();
            _this.ruleDisplay();
        },
        // Close panel
        cancel: () => {
            _this.close();
        },
        // Close panel
        update: () => {
            _this.ruleDisplay();
        },
        // Save field
        save: (f) => {

            // Send assets field
            if(f.validate())
            {
                let data = {
                    name: _this.parameters.__name,
                    type: _this.parameters.__type,
                    description: _this.parameters.__description,
                    required: _this.parameters.__required,
                    data: _this.parameters.__values,
                }

                _this.parameters.__load = 1;


                // Create
                if( _this.id == '' )
                {
                    axios.post( 'assets/field', data ).then( (response) => {

                        if( _this.successCallBack != undefined )
                            _this.successCallBack( response.data );

                        _this.parameters.__load = 0;
                        _this.close();
                    }).catch(() => {
                        _this.parameters.__load = 0;
                    });
                }
                // Edit
                else
                {
                    axios.put( 'assets/field/'+_this.id, data ).then( (response) => {

                        if( _this.successCallBack != undefined )
                            _this.successCallBack( response.data );

                        _this.parameters.__load = 0;
                        _this.close();
                    }).catch(() => {
                        _this.parameters.__load = 0;
                    });
                }
            }
        },
    }

    // Process form
    this.process = (f) => {

        if(this.rules.needValues( f.parameters ))
        {
            if( _this.$scope.querySelector( '.fields-values' ).children.length == 0 )
                _this.addFieldValue();
        }
    }

    // Add New field value
    this.addFieldValue = (v) => {

        if(v == undefined)
            v = '';

        let f = _this.$scope.querySelector( '.fields-values' );
        let c = components.createDiv('form-input-action mb-2');

        c.innerHTML = `
        <input type="text" class="form-control" name='values[]' required value="${v}" />
        <i class='fa-thin fa-trash-can' actionRun='remove'></i>
        `;

        f.appendChild(c);
    }

    // Open field
    this.openDisplay = (d) => {

        // allways remove values
        _this.$scope.querySelector( '.fields-values' ).innerHTML = '';

        // Is new fiels
        if( d == null )
        {
            _this.parameters.__name = '';
            _this.parameters.__description = '';
            _this.parameters.__type = 'input';
            _this.parameters.__required = 1;

            _this.id = '';
        }
        // Edit field mode
        else
        {
            _this.parameters.__name = d.name;
            _this.parameters.__description = d.description;
            _this.parameters.__type = d.type;
            _this.parameters.__required = d.required;

            for (let i = 0; i < d.data.length; i++)
            {
                if( d.data[i] != null && d.data[i] != '' )
                    _this.addFieldValue(d.data[i]);
            }

            _this.id = d.id;
        }

        _this.ruleDisplay();
    }


    _this._construtor();
}




























// Show user of the BO
window.PanelActive = function( $scope, __config )
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

        this.table = new SuperTable( document.querySelector('.table'),
        {
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
                equipment: __config.lang.equipment,
                category: __config.lang.category,
                risk: __config.lang.risk,
                responsable: __config.lang.responsable,
                alerts: __config.lang.alerts,
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