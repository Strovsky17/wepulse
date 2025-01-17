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
    
    // Remove Client from database
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

// Create Edit Asset
window.PanelAsset = function( $scope, asset )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );

        this.clear();
        this.fillAsset();
    }

    // Rules
    this.rules = {
        preload: (p) => { return p.__mode != '2'; },
        edit: (p) => { return p.__id != ''; },
        load: (p) => { return p.__load == '1'  }
    }

    // Actions
    this.actions = {

        save: ( f ) => {

            if( f.validate() )
            {
                _this.parameters.__load = 1;

                let data = {
                    name: f.parameters.__name,
                    category_id: f.parameters.__category_id,
                    risk: f.parameters.__risk,
                    criticality: f.parameters.__criticality,
                    data: {}
                }

                // Key não foi encontrada passa a informação para o data
                let ignore = [ '__name','__category_id', '__risk', '__criticality', '__load', '__id', '__mode' ];
                let properties = Object.getOwnPropertyNames(f.parameters);
                properties.forEach( key => {
                    if( ignore.indexOf( key ) == -1 )
                        data.data[ key.replace('__', '') ] = f.parameters[key];  
                });

                // Create
                if( _this.parameters.__id == '' )
                {
                    axios.post( 'assets/assets', data ).then((response)=> {

                        asset = response.data
                        _this.fillAsset();
                    }).
                    catch(() => {
                        _this.parameters.__load = 0;
                    });
                }
                // Edit
                else
                {
                    axios.put( 'assets/assets/'+_this.parameters.__id, data ).then((response)=> {

                        asset = response.data
                        _this.fillAsset();
                    }).
                    catch(() => {
                        _this.parameters.__load = 0;
                    });
                }
            }
        },
        edit: (f) => {
            f.parameters.__mode = 1;
        },
        changeShowHide: (f , $el) => {
            if(f.__id != '')
                $el.classList.toggle('show');
            else
                $el.classList.add('show');
        }

    }

    // Process form
    this.clear = () => {

        _this.parameters.__mode = 2;
        _this.parameters.__load = 1;

        // Clear
        let properties = Object.getOwnPropertyNames(_this.parameters);
        properties.forEach( key => {
            if( key != '__mode' && key != '__load' )
                _this.parameters[key] = '';
        })
    }

    this.fillAsset = () => {

        // Adiciona os valores
        if( asset.id != undefined )
        {
            _this.parameters.__id = asset.id;
            _this.parameters.__name = asset.name;
            _this.parameters.__risk = asset.risk;
            _this.parameters.__criticality = asset.criticality;
            _this.parameters.__category_id = asset.category_id;

            for (const key in asset.data)
            {
                if(key == 'image')
                    _this.parameters['__'+key] = asset.data[key] ?? '';
                else
                    _this.parameters['__'+key] = asset.data[key] ?? '-';
            }

            _this.parameters.__mode = 0;

            // Depois da pagina ter feito load
            if(window.pAssetTableEvents != undefined)
            {
                window.pAssetTableEvents.setAsset( asset );
                window.pAssetTableEvents.show();
            }
        }
        else
        {
            _this.parameters.__mode = 1;
        }

        setTimeout(() => {
            _this.parameters.__load = 0;
        },500);
    }

    // Get Asset
    this.getAsset = () => {
        return asset;
    }

    _this._construtor();
}

// Show user of the BO
window.PanelAssets = function( $scope, __config )
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
            window.location.href = 'assets/asset/';
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
                category_id: `<div class="text-center">${window.tableLang.category}</div>`,
                risk: `<div class="text-center">${window.tableLang.risk}</div>`,
                responsable: `<div class="text-center">${window.tableLang.responsable}</div>`,
                alerts: `<div class="text-center">${window.tableLang.alerts}</div>`,
            },
            data: __config.data,
            process_value_required: (v) => {
                if(v == true)
                    return '<div class="text-center"><i class="fa-regular fa-square-check"></i></div>';
                else
                    return '<div class="text-center"><i class="fa-regular fa-square-xmark"></i></div>';
            },
            process_value_category_id: (v) => {

                for (let i = 0; i < __config.categories.length; i++)
                {
                    if(__config.categories[i].id == v)
                        return `<div class="text-center">${__config.categories[i].name}</div>`;    
                }

                return `<div class="text-center"></div>`;
            },
            process_value_responsable: (v) => {
                return `<div class="text-center">${v.data.responsable ?? '-'}</div>`;
            },
            process_value_risk: (v) => {
                if( v == 1 )
                    return `<div class="text-center text-success">Baixo</div>`;
                else if( v == 2 )
                    return `<div class="text-center text-warning">Moderado</div>`;
                else if( v == 3 )
                    return `<div class="text-center text-danger">Alto</div>`;
            },
            process_value_alerts: (v) => {
                return `<div class="div-center"><div class='text-success bg-success'> Sem Alertas</div></div>`;
            },
            actions:[
                { 'cls':'primary', 'icon':'thin fa-pen-to-square', label: '', callback: (d) => { 
                    window.location.href = 'assets/asset/'+d.id;
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => {
                    window.WepulseModal( 'confirm', ( flag ) => {
                        if( flag == true )
                        {
                            axios.delete( 'assets/assets/'+d.id ).then( (response) => {
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
window.PanelAssetsTableCategory = function( $scope, __config )
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
            window.pAssetsCategory.open( null,  _this.processList );
        },
    }

    this.process = () => {

        if( this.table != null )
        {
            this.table.$search.value = this.parameters.__search;
            this.table.search();
        }
    }

    // Add Category to database
    this.processList = (category) => {

        let data = _this.table.config.data;
        for (let i = 0; i < data.length; i++) 
        {
            const f = data[i];
            if( f.id == category.id )
            {
                data[i] = category;
                _this.table.search();
                return true;
            }
        }

        _this.table.config.data.push(category);
        _this.table.search();
    }
    
    // Remove Category from database
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
                    window.pAssetsCategory.open( d,  _this.processList );
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => {
                    window.WepulseModal( 'confirm', ( flag ) => {
                        if( flag == true )
                        {
                            axios.delete( 'assets/category/'+d.id ).then( (response) => {
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
window.PanelAssetsCategory = function( $scope )
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
        load: (p) => { return p.__load == '1'  }
    }

    // Actions
    this.actions = {
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
                }

                _this.parameters.__load = 1;
                // Create
                if( _this.id == '' )
                {
                    axios.post( 'assets/category', data ).then( (response) => {

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
                    axios.put( 'assets/category/'+_this.id, data ).then( (response) => {

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

    // Open field
    this.openDisplay = (d) => {

        // Is new fiels
        if( d == null )
        {
            _this.parameters.__name = '';
            _this.id = '';
        }
        // Edit field mode
        else
        {
            _this.parameters.__name = d.name;
            _this.id = d.id;
        }

        _this.ruleDisplay();
    }

    _this._construtor();
}

// Show user of the BO
window.PanelAssetsTableEvents = function( $scope, __config )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );
    
        _this.parameters.__search = '';
        _this.asset = null;
        _this.initTable();
    }

    // Initialize table
    this.initTable = () => {

        let requestParameters = {};
        let columns = {
            asset: window.tableLang.asset,
            date: window.tableLang.date,
            who: window.tableLang.who,
            description: window.tableLang.sortDescription,
            next: window.tableLang.nextAction,
        };

        if( __config.asset_mode == 1 )
        {
            _this.asset = window.pAsset.getAsset();

            delete columns.asset;             
            requestParameters = { 'asset_id': _this.asset.id ?? 0 }

            if( _this.asset.id != null )
                _this.show();
        }
        else
        {
            _this.show();
        }

        this.table = new SuperTable( document.querySelector('.table'),{
            paginationUrl: 'assets/search/event',
            rowsPerPage: 10,
            perPage: false,
            search: false,
            requestParameters: requestParameters,
            columns: columns,
            actions:[
                { 'cls':'primary', 'icon':'thin fa-pen-to-square', label: '', callback: (d) => { 
                    window.pAssetsHistory.open( d,  _this.processList );
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => {
                    window.WepulseModal( 'confirm', ( flag ) => {
                        if( flag == true )
                        {
                            axios.delete( 'assets/category/'+d.id ).then( (response) => {
                                _this.removeList(d.id);
                            }).catch(() => {

                            });
                        }
                    });
                }},
            ]
        });
    }

    this.rules = {
        mode: () => { return __config.asset_mode }
    }

    this.actions = {

        add: () => {
            window.pAssetsEvent.setAsset( _this.asset );
            window.pAssetsEvent.open( null,  _this.processList );
        },
        changeShowHide: (f , $el) => {
            if(f.__id != '')
                $el.classList.toggle('show');
            else
                $el.classList.add('show');
        }
    }

    // Set Asset
    this.setAsset = (asset) => {
        
        _this.asset = asset;
        _this.table.config.requestParameters = { 'asset_id': _this.asset.id ?? 0 };
        _this.show();
    }

    // Process info
    this.process = () => {

        if( this.table != null )
        {
            this.table.$search.value = this.parameters.__search;
            this.table.search();
        }
    }

    // Add History to database
    this.processList = (history) => {

        let data = _this.table.config.data;
        for (let i = 0; i < data.length; i++) 
        {
            const f = data[i];
            if( f.id == category.id )
            {
                data[i] = history;
                _this.table.search();
                return true;
            }
        }

        _this.table.config.data.push(history);
        _this.table.search();
    }
    
    // Remove History from database
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

    _this._construtor();
}

// Show user of the BO
window.PanelAssetsEvent = function( $scope )
{
    let _this = this;

    this.$scope = $scope;

    // Init the constructor
    this._construtor = function()
    {
        new Panel( this );

        _this.parameters.__asset = 1;
    }

    // Rules
    this.rules = {
        load: (p) => { return p.__load == '1'  },
        asset: (p) => { return p.__asset == '1'  },
    }

    // Actions
    this.actions = {
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
                }

                _this.parameters.__load = 1;

                // Create
                if( _this.id == '' )
                {
                    axios.post( 'assets/history', data ).then( (response) => {

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
                    axios.put( 'assets/history/'+_this.id, data ).then( (response) => {

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

    // Create Assets
    this.createAssets = (assets) => {

        let options = $scope.querySelector('[name="asset_id"] > div:nth-child(2)');
        options.innerHTML = '<div value=""></div>';

        for (let i = 0; i < assets.length; i++)
            options.innerHTML += `<div value="${assets[i].id}">${assets[i].name}</div>`;
    }

    // Set Assets
    this.setAsset = ( asset ) => {

        if(asset == null)
        {
            _this.parameters.__asset = 1;
            _this.parameters.__load = 1;

            axios.post( 'assets/search/asset', { all: true, simple: true } ).then( (response) => {
                _this.createAssets( response.data );

                _this.parameters.__asset_id = '';
                _this.parameters.__load = 0;
            }).catch((r) => {
    
                console.log(r);
                _this.parameters.__load = 0;
            });
        }
        else
        {
            _this.createAssets( [asset] );

            _this.parameters.__asset_id = asset.id;
            _this.parameters.__asset = 0;
        }
    }

    // Open field
    this.openDisplay = (d) => {

        // Is new fiels
        if( d == null )
        {
            _this.parameters.__name = '';
            _this.id = '';
        }
        // Edit field mode
        else
        {
            _this.parameters.__name = d.name;
            _this.id = d.id;
        }

        _this.ruleDisplay();
    }

    _this._construtor();
}















// Show user of the BO
window.PanelAssetsTableAlert = function( $scope, __config )
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
            window.pAssetsAlert.open( null,  _this.processList );
        },
    }

    this.process = () => {

        if( this.table != null )
        {
            this.table.$search.value = this.parameters.__search;
            this.table.search();
        }
    }

    // Add Alert to database
    this.processList = (alert) => {

        let data = _this.table.config.data;
        for (let i = 0; i < data.length; i++) 
        {
            const f = data[i];
            if( f.id == category.id )
            {
                data[i] = alert;
                _this.table.search();
                return true;
            }
        }

        _this.table.config.data.push(alert);
        _this.table.search();
    }
    
    // Remove Alert from database
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
                type: window.tableLang.type,
                asset: window.tableLang.asset,
                category: window.tableLang.category,
                date: window.tableLang.date,
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
                    window.pAssetsHistory.open( d,  _this.processList );
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => {
                    window.WepulseModal( 'confirm', ( flag ) => {
                        if( flag == true )
                        {
                            axios.delete( 'assets/category/'+d.id ).then( (response) => {
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
window.PanelAssetsAlert = function( $scope )
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
        // Add Alert Value
        add: () => {
            _this.addAlertValue();
        },
        // Remove Alert Value
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
        // Save alert
        save: (f) => {

            // Send assets alert
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
                    axios.post( 'assets/alert', data ).then( (response) => {

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
                    axios.put( 'assets/alert/'+_this.id, data ).then( (response) => {

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
            if( _this.$scope.querySelector( '.alerts-values' ).children.length == 0 )
                _this.addFieldValue();
        }
    }

    // Add New field value
    this.addFieldValue = (v) => {

        if(v == undefined)
            v = '';

        let f = _this.$scope.querySelector( '.alerts-values' );
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
        _this.$scope.querySelector( '.alerts-values' ).innerHTML = '';

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
                    _this.addAlertValue(d.data[i]);
            }

            _this.id = d.id;
        }

        _this.ruleDisplay();
    }


    _this._construtor();
}


// Show user of the BO
window.PanelAssetsTableResponsable = function( $scope, __config )
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
            window.pAssetsResponsable.open( null,  _this.processList );
        },
    }

    this.process = () => {

        if( this.table != null )
        {
            this.table.$search.value = this.parameters.__search;
            this.table.search();
        }
    }

    // Add Responsable to database
    this.processList = (responsable) => {

        let data = _this.table.config.data;
        for (let i = 0; i < data.length; i++) 
        {
            const f = data[i];
            if( f.id == responsable.id )
            {
                data[i] = responsable;
                _this.table.search();
                return true;
            }
        }

        _this.table.config.data.push(responsable);
        _this.table.search();
    }
    
    // Remove Responsable from database
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
                email: window.tableLang.email,
                contact: window.tableLang.contact,
                departmentcompany: window.tableLang.departmentcompany,
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
                    window.pAssetsResponsable.open( d,  _this.processList );
                }},
                { 'cls':'primary', 'icon':'thin fa-trash-can', label: '', callback: (d) => {
                    window.WepulseModal( 'confirm', ( flag ) => {
                        if( flag == true )
                        {
                            axios.delete( 'assets/responsable/'+d.id ).then( (response) => {
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
window.PanelAssetsResponsable = function( $scope )
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
        load: (p) => { return p.__load == '1'  }
    }

    // Actions
    this.actions = {
        // Close panel
        cancel: () => {
            _this.close();
        },
        // Close panel
        update: () => {
            _this.ruleDisplay();
        },
        // Save responsable
        save: (f) => {

            // Send responsables responsable
            if(f.validate())
            {
                let data = {
                    name: _this.parameters.__name,
                    email: _this.parameters.__email,
                    contact: _this.parameters.__contact,
                    departmentcompany: _this.parameters.__departmentcompany,
                }

                _this.parameters.__load = 1;
                // Create
                if( _this.id == '' )
                {
                    axios.post( 'assets/responsable', data ).then( (response) => {

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
                    axios.put( 'assets/responsable/'+_this.id, data ).then( (response) => {

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

    // Open responsables
    this.openDisplay = (d) => {

        // Is new responsables
        if( d == null )
        {
            _this.parameters.__name = '';
            _this.parameters.__email = '';
            _this.parameters.__contact = '';
            _this.parameters.__company = '';
            _this.id = '';
        }
        // Edit responsable mode
        else
        {
            _this.parameters.__name = d.name;
            _this.parameters.__email = d.email;
            _this.parameters.__contact = d.contact;
            _this.parameters.__company = d.company;
            _this.id = d.id;
        }

        _this.ruleDisplay();
    }

    _this._construtor();
}
