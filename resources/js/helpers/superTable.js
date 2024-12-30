// Created pop up to send Notification
window.SuperTable = function( $scope, config )
{
    let _this = this;

    // Configs default
    _this.config = {
        rowsPerPage: 10,
        data: [],
        actions: [],
        columns: null,
        create: null,
        paginationUrl: '',
        lang: {
            search: 'Search',
            next: 'Next',
            prev: 'Prev',
            countPage: 'Showing $1 to $2 of $3 rows',
            noResults: 'No results found',
            create: 'Create'
        }
    }

    // Init the constructor
    this._construtor = function()
    {
        // Rewrite configuration
        if( config != undefined )
            config = Object.assign(_this.config, config);

        this.ajax = _this.config.paginationUrl == '' ? false : true;
        this.total = 0;
        this.page = 1;
        this.data = [];
        this.dataPage = {};
        this.building = false;

        this.createOptions();
        this.createTable();
        this.createPagination();

        this.build();
    }

    /**
     * Create Options
     * 
     * @returns {void}
     */
    this.createOptions = function()
    {
        _this.$options = components.createDiv('table-options');
     
        // Create Button
        if( _this.config.create != null )
            
        {
            if( typeof(_this.config.create) == 'string' )
                _this.$options.appendChild(  components.createA( _this.config.lang.create, 'btn btn-zapify btn-primary mb-2', { href: _this.config.create } )  );
            else
            {
                let $a = components.createA( _this.config.lang.create, 'btn btn-zapify btn-primary mb-2', {href: 'javascript:void(0)'} );
                $a.onclick = _this.config.create;
                _this.$options.appendChild( $a );
            }
          
        }
      

        // Search
        _this.$search = components.createInput( 'text', 'form-control form-search', { placeholder: _this.config.lang.search } );
        _this.$divSearch = components.createDiv('table-options-search');        
        _this.$divSearch.appendChild( _this.$search );
        _this.$divSearch.appendChild( components.createI('fa-regular fa-magnifying-glass') );
        _this.$options.appendChild( _this.$divSearch );
        
        // Show number per page
        let $perPage = components.createDiv('perPage');
        let options = [1, 5,10,25,50,100];
        if( options.indexOf( _this.config.rowsPerPage ) == -1 )
        {
            options.push( _this.config.rowsPerPage );
            options.sort();
        }

        _this.$select = components.createSelect( 'form-select form-select-lg form-group', options );
        _this.$select.value = _this.config.rowsPerPage;
        $perPage.appendChild( components.createH('5', 'Rows Per Page:') );
        $perPage.appendChild( _this.$select );
        $scope.appendChild(_this.$options);


        // Actions
        _this.$select.onchange = function() {
            _this.dataPage = {};
            _this.goTo( 1 );
        }

        _this.$search.onkeyup = _this.search

        // PagTotal
        _this.$paginationTotal = components.createDiv( 'total' );
        _this.$options.appendChild(_this.$paginationTotal);
    }

    /**
     * Create Table
     * 
     * @returns {void}
     */
    this.createTable = function()
    {
        let $tableResponse = components.createDiv('table-responsive');
        _this.$table = components.createTable('table table-striped table-hover');
        
        // Add elements to layout
        $tableResponse.appendChild(_this.$table);
        $scope.appendChild($tableResponse);
    }

    /**
     * Create Pagination
     * 
     * @returns {void}
     */
    this.createPagination = function()
    {
        let $pagination = components.createDiv('table-pagination');
        _this.$paginationButtons = components.createDiv('');
        _this.$paginationNoResults = components.createDiv( 'total' );         
        _this.$paginationNoResults.innerHTML = _this.config.lang.noResults;

        _this.$pagination = components.createDiv( 'pagination' ); 
        _this.$prev = components.createButton( _this.config.lang.prev, 'btn' ); 
        _this.$next = components.createButton( _this.config.lang.next, 'btn' ); 

        $pagination.appendChild( _this.$paginationNoResults );
        $pagination.appendChild( _this.$pagination );

        _this.$pagination.appendChild( _this.$prev );
        _this.$pagination.appendChild( _this.$paginationButtons );
        _this.$pagination.appendChild( _this.$next );

        _this.$prev.onclick = function(){
            _this.page--;
            _this.goTo( _this.page );
        }
        
        _this.$next.onclick = function(){
            _this.page++;
            _this.goTo( _this.page );
        }

        $scope.appendChild($pagination);
    }

    /**
     * Create Column
     * 
     * @param type { th, td }
     * @param valor
     * @returns {void}
     */
    this.createColumn = function( type, valor, key )
    {
        let c = document.createElement( type );

        if(  _this.config['process_el_'+key] != undefined )
            c.appendChild(_this.config['process_el_'+key]( valor ));
        else if(  _this.config['process_value_'+key] != undefined )
            c.innerHTML = _this.config['process_value_'+key]( valor );
        else if( typeof(valor) === 'object' )
            c.innerHTML = '-';    
        else
            c.innerHTML = valor;

        return c;
    }

    /**
     * Validated who is the table will be construct
     * 
     * @returns {void}
     */
    this.build = async function()
    {
        // By Urls
        if( _this.ajax )
        {
            // Get the information from template
            await axios.post(_this.config.paginationUrl, { 'per_page': _this.config.rowsPerPage }).then((response) => 
            {
                _this.total = response.data.total;
                _this.dataPage[ 1 ] = response.data.data;

                _this.buildHead();
                _this.buildBody();
            }).catch((err) => {
                console.log(err);
            });
        }
        else
        {
            _this.data = [].concat(_this.config.data);

            _this.buildHead();
            _this.buildBody();
        }
    }

    /**
     * Build Head
     * 
     * @returns {void}
     */
    this.buildHead = function()
    {
        let tr = document.createElement('tr');

        // Construct by option
        if( _this.config.columns != null )
        {
            for (const key in _this.config.columns)
            {
                let c = _this.config.columns[key];
                tr.appendChild( this.createColumn( 'th', typeof(c) === 'object' ? c.label : c)  );
            }
        }
        // Construct head by fields
        else
        {
            let head = {};
            this.headKey = [];

            if( _this.ajax == true)
                head = _this.data[0];
            else
                head = _this.config.data[0];

            // Verified if exist results
            if(head != undefined)
            {
                // ID always the first one
                if( head['id'] != undefined )
                {
                    tr.appendChild( this.createColumn( 'th', '#' ) );
                    this.headKey.push('id');
                }

                for (const thead in head)
                {
                    if(thead != 'id')
                    {
                        tr.appendChild( this.createColumn( 'th', thead ) );
                        this.headKey.push(thead);
                    }
                }
            }
        }

        // Add column option
        if( _this.config.actions.length > 0 )
            tr.appendChild( this.createColumn( 'th', '' ) );

        _this.$table.thead.appendChild(tr);
    }

    /**
     * Build Body
     * 
     * @returns {void}
     */
    this.buildBody = function()
    {
        _this.$table.tbody.innerHTML = '';

        let data = _this.getCurrentData();

        for (let i = 0; i < data.length; i++)
        {
            let tr = document.createElement('tr');
        
            // Construct by option
            if( _this.config.columns != null )
            {
                for (const key in _this.config.columns)
                {
                    let c = _this.config.columns[key];
                    let cm = null;

                    if( data[i][ key ] == undefined)
                        cm = _this.createColumn( 'td', data[i], key);
                    else
                        cm = _this.createColumn( 'td', data[i][ key ], key);

                    tr.appendChild( cm );
                }
            }
            // Construct head by fields
            else
            {
                for (let j = 0; j < _this.headKey.length; j++)
                {
                    if( data[i][ _this.headKey[j] ]  == undefined)
                        tr.appendChild( _this.createColumn( 'td', '') );
                    else
                        tr.appendChild( _this.createColumn( 'td', data[i][ _this.headKey[j] ]) );
                }
            }

            // Add column option
            if( _this.config.actions.length > 0 )
            {
                let ca = _this.createColumn( 'td', '' );
                _this.buildActions(ca, data[i]);
                tr.appendChild( ca );
            }

            _this.$table.tbody.appendChild(tr);
        }

        _this.buildPagination();
    }

    /**
     * Build Action
     * 
     * @returns {void}
     */
    this.buildActions = function( ca, data )
    {
        ca.style.width = 55;

        let options = components.createDiv('options');
        let list = components.createDiv('box-zapify d-none');
        let menu = components.createI('fa-solid fa-ellipsis-vertical','');

        options.appendChild(menu); 
        options.appendChild(list);
        
        let flag = false;

        for (let i = 0; i < _this.config.actions.length; i++)
        {
            let c = _this.config.actions[i];
            if( c.approved != undefined && !c.approved(data) )
            {
                // Not doing anything
            }
            else
            {
                let label = ( c.icon != undefined ? '<i class="fa fa-'+c.icon+'"></i>' : '')+( c.label != undefined ? c.label: '' );
                let b = components.createButton(label, '', () => {
                    if( c.callback != undefined )
                        c.callback( data );
                });
                
                list.appendChild(b);
                flag = true;
            }
        }

        if( flag == true )
        {
            let hideMenu = ( e ) => {

                if(e.target == menu)
                    return false;

                setTimeout( () => { 
                    list.classList.add('d-none');
                    document.body.removeEventListener( 'click', hideMenu ); 
                }, 100);
                
            }

            menu.onclick = () =>  {
                list.classList.toggle('d-none');
                document.body.addEventListener( 'click', hideMenu );
            }

            ca.appendChild( options );
        }
    }

    /**
     * Create Pagination info
     * @returns 
     */
    this.buildPagination = function()
    {
        if( _this.total == 0 )
        {
            _this.$paginationTotal.style.display = 'none';
            _this.$paginationNoResults.style.display = 'block';
            _this.$pagination.style.display = 'none';
        }
        else
        {
            _this.$paginationNoResults.style.display = 'none';
            _this.$paginationTotal.style.display = 'block';

            // Info from pagination
            let start = (_this.page - 1) * _this.$select.value + 1;
            let end = _this.page * _this.$select.value;
            if( end > parseInt(_this.total / _this.$select.value))
                end = parseInt(_this.total / _this.$select.value);

            let countPage =  _this.config.lang.countPage;
            countPage = countPage.replace('$1', start);
            countPage = countPage.replace('$2', end);
            countPage = countPage.replace('$3', _this.total);

            _this.$paginationTotal.innerHTML = countPage;

            // Create pagination
            
            let totalPages = Math.ceil(_this.total / parseInt(_this.$select.value));
            if( totalPages <= 1 )
                _this.$pagination.style.display = 'none';
            else
                _this.$pagination.style.display = 'table';

            let pages = []; 

            _this.$next.classList.add('hidden');
            _this.$prev.classList.add('hidden');

            if( totalPages <= 7 )
            {
                for (let i = 1; i <= totalPages ; i++)
                    pages.push(i);
            }
            else 
            {
                _this.$next.classList.remove('hidden');
                _this.$prev.classList.remove('hidden');

                if(  totalPages - 1 <= _this.page )
                    pages = [ 1, '...', totalPages - 2, totalPages - 1, totalPages  ];
                else if( _this.page == 1 )
                    pages = [ 1, 2, 3, '...', totalPages];
                else
                    pages = [ _this.page - 1, _this.page, _this.page + 1, '...', totalPages];                
            }

            _this.$paginationButtons.innerHTML = '';
            for (let i = 0; i < pages.length; i++)
            {
                let b = components.createButton( pages[i], 'btn' );

                if( pages[i] == _this.page )
                    b.classList.add('btn-primary')

                if( pages[i] != '...' )
                {
                    b.onclick = function() {
                        _this.goTo(this.innerHTML);
                    }
                }

                _this.$paginationButtons.appendChild(b);
            }

            if( _this.page == 1 )
                _this.$prev.disabled = 'disabled';  
            else 
                _this.$prev.removeAttribute('disabled');
            
            if( _this.page == totalPages )
                _this.$next.disabled = 'disabled';  
            else 
                _this.$next.removeAttribute('disabled');
        }

        _this.building = false;
    }

    /**
     * Get Table information form current page
     * 
     * @returns {array}
     */
    this.getCurrentData = function()
    {
        if( _this.ajax )
        {
            return _this.dataPage[_this.page];
        }
        else
        {
            let data = [];
            _this.total = _this.data.length;

            for (let i = (_this.page - 1) * _this.$select.value; i < _this.page * _this.$select.value; i++)
            {
                if( _this.data[i] == undefined )
                    return data;
                    
                data.push( _this.data[i] );
            }

            return data;
        }
    }

    /**
     * GoTo
     * 
     * @returns {void}
     */
    this.goTo = function(page)
    {
        if(_this.building)
            return false;
        
        _this.building = true;

        // Search on database
        if( _this.ajax )
        {
            _this.page = parseInt(page);

            // Use storage info
            if( _this.dataPage[ page ] != undefined )
            {
                _this.buildBody();
            }
            else
            {
                // Get the information from template
                axios.post(_this.config.paginationUrl, {'page':page, 'per_page': _this.$select.value, 'search': _this.$search.value }).then((response) => 
                {
                    _this.total = response.data.total;
                    _this.dataPage[ page ] = response.data.data;
                    _this.buildBody();

                    console.log(_this.flashCallback);
                    if( _this.flashCallback != undefined )
                    {
                        _this.flashCallback( response.data );
                        _this.flashCallback = undefined;
                    }

                }).catch((err) => {
                    console.log(err);
                });
            }
        }
        // Search on current info
        else
        {
            _this.page = parseInt(page);

            // Rebuild Table
            _this.buildBody();
        }
    }

    /**
     * Search Results
     * 
     * @returns {void}
     */
    this.refresh = function()
    {
        if( _this.dataPage[ _this.page ] != undefined )
            _this.dataPage = [];

        _this.goTo( _this.page );
    }

    /**
     * Search Results
     * 
     * @returns {void}
     */
    this.search = function()
    {
        // Search on database
        if( _this.ajax )
        {
            if( _this.delay != undefined )
                clearTimeout( _this.delay );

            _this.delay = setTimeout( () => {
                _this.dataPage = {};
                _this.delay = undefined;
                _this.goTo(1);
            },500);
        }
        // Search on current info
        else
        {
            _this.data = [];

            let search = _this.$search.value.toLowerCase();

            // Return all of the data
            if( search == '' )
            {
                _this.data = _this.config.data;
            }
            else
            {
                for (let i = 0; i < _this.config.data.length; i++)
                {
                    let object = _this.config.data[i];
                    if( _this.validateSearch( object, search))
                        _this.data.push(object);
                }    
            }
        }

        // Rebuild Table
        _this.buildBody();
    }

    /**
     * To Get better perform
     * 
     * @returns boolean
     */
    this.validateSearch = function( object, search)
    {
        for (const key in object)
        {
            if (typeof(object[key]) == 'string' && object[key].toString().toLowerCase().includes( search ) )
                return true;
            else if (typeof(object[key]) == 'object')
            {
                if( this.validateSearch( object[key], search ) )
                    return true;
            }
        }

        return false;
    }

    /**
     * Set URL
     */
    this.setURL = (url, flashCallback) => {

        this.config.paginationUrl = url;
        this.ajax = true;

        this.building = false;
        this.dataPage = {};
        this.flashCallback = flashCallback;

        this.goTo(1);
    }

    _this._construtor();   
}