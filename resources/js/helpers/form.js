// Created pop up to send Notification
window.PForm = function( $scope, config )
{
    let _this = this;

    this.config = {
        url: '',
        goTo: '',
        rules: {},
        actions: {},
        lang: {
            errorTitle:'Error',
            errorMessage:'Something went wrong.',
            successTitle:'Success',
            successMessage:'Form success submit.'
        }
    }

    // Init the constructor
    this.construtor = () => {

        // Rewrite configuration
        if( config != undefined )
            config = Object.assign(_this.config, config);

        // Set infomation
        this.buildParameters();
        this.buildActions();
        this.buildCounts();
        this.rules();
    }

    /**
     * Set the valores of parameters
     */
    this.buildParameters = () => {

        this.parameters = {};
        let $els = $scope.querySelectorAll('[name]');

        for (let i = 0; i < $els.length; i++) 
        {
            const $el = $els[i];

            if( this['build'+$el.nodeName.toUpperCase()] != undefined)
                this['build'+$el.nodeName.toUpperCase()]( $el )
        }
    }

    /**
     * Build INPUT
     */
    this.buildINPUT = ( $el ) => {
        
        if( $el.type == 'radio' ) {            

            $el.onchange = _this.rules;

            if( !this.parameters.hasOwnProperty('__'+$el.getAttribute('name')) )
            {
                Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
                    get() {
                        let $c = $scope.querySelector('[name="'+$el.getAttribute('name')+'"]:checked');
                        if( $c != null  && $c.getAttribute('disabled') == undefined )
                            return $c.value;

                        return '';
                    },
                    set( v ) {

                        let $c = $scope.querySelectorAll('[name="'+$el.getAttribute('name')+'"]');
                        for (let i = 0; i < $c.length; i++)
                        {
                            if( $c[i].value  == v)
                                $c[i].checked = true;
                            else
                                $c[i].checked = false;
                        }

                        let to = $el.getAttribute('to');
                        if( to != null  && $el.parentNode.parentNode.querySelector(to))
                            $el.parentNode.parentNode.querySelector(to).innerHTML = v;
                    }
                });
            }
        }
        else if( $el.type == 'checkbox' ) {            

            $el.onchange = _this.rules;

            if( !this.parameters.hasOwnProperty('__'+$el.getAttribute('name')) )
            {
                Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
                    get() {
                        let data = [];
                        let $c = $scope.querySelectorAll('[name="'+$el.getAttribute('name')+'"]');
                        for (let i = 0; i < $c.length; i++)
                        {
                            if($c[i].checked === true)
                                data.push( $c[i].value );
                        }
                        
                        return data;
                    },
                    set( data ) {
                        
                        let $c = $scope.querySelectorAll('[name="'+$el.getAttribute('name')+'"]');
                        for (let i = 0; i < $c.length; i++)
                        {
                            if( data.indexOf( $c[i].value ) != -1)
                                $c[i].checked = true;
                            else
                                $c[i].checked = false;
                        }
                    }
                });
            }
        }
        else
        {
            if( $el.type == 'date' )
                $el.onchange = _this.rules;
            else if($el.type == 'time' ||  $el.type == 'text' )
                $el.onkeyup = () => { 
                    let to = $el.getAttribute('to');
                    if( to != null  && $el.parentNode.querySelector(to))
                        $el.parentNode.querySelector(to).innerHTML = $el.value;

                    _this.rules();
                }
            else if($el.type == 'hidden' )
                $el.onchange = _this.rules;


            // Array
            if( $el.getAttribute('name').includes('[]') )
            {
                let name = $el.getAttribute('name').replace('[]', '')

                Object.defineProperty( this.parameters, '__'+name, {
                    get() {
                        
                        let data = [];
                        let $c = $scope.querySelectorAll('[name="'+name+'[]"]');
                        for (let i = 0; i < $c.length; i++)
                            data.push($c[i].value);
    
                        return data;
                    },
                    set( v ) {
                        _this.rules();
                    }
                });
            }
            else
            {
                Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
                    get() {
                        let format = $el.getAttribute('format')
                        if( format == 'json' )
                        {
                            if($el.value == '')
                                return null;
    
                            return JSON.parse($el.value);
                        }
    
                        return $el.value;
                    },
                    set( v ) {
    
                        if( v == 'makeInvalid' )
                        {
                            $el.classList.add('is-invalid');
                            return true;
                        }
                        
                        if( v == 'makeValid' )
                        {
                            $el.classList.remove('is-invalid');
                            return true;
                        }
                        
                        let to = $el.getAttribute('to');
                        if( to != null  && $el.parentNode.querySelector(to))
                            $el.parentNode.querySelector(to).innerHTML = v;
    
    
                        if($el.value == v)
                            return true;
    
                        let format = $el.getAttribute('format')
                        if( format == 'json' )
                            $el.value = JSON.stringify(v);
                        else
                            $el.value = v;
    
                        if($el.change != undefined )
                            $el.change( $el );
    
                        _this.rules();
                    }
                });
            }

            
        }
    }
    
    /**
     * Build SELECT
     */
    this.buildSELECT = ( $el ) => {

        Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
            get() {
                return $el.value;
            },
            set( v ) {

                if( v == 'makeInvalid' )
                {
                    $el.classList.add('is-invalid');
                    return true;
                }
                
                if( v == 'makeValid' )
                {
                    $el.classList.remove('is-invalid');
                    return true;
                }

                $el.value = v;
            }
        });
 
        $el.addEventListener( 'change', this.rules);
    }
    
    /**
     * Build TEXTAREA
     */
    this.buildTEXTAREA = ( $el ) => {

        Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
            get() {
                return $el.value;
            },
            set( v ) {
                
                if( v == 'makeInvalid' )
                {
                    $el.classList.add('is-invalid');
                    return true;
                }
                
                if( v == 'makeValid' )
                {
                    $el.classList.remove('is-invalid');
                    return true;
                }
                
                let to = $el.getAttribute('to');
                if( to != null  && $el.parentNode.querySelector(to))
                    $el.parentNode.querySelector(to).innerHTML = v;

                $el.value = v;

                if($el.change != undefined )
                    $el.change();
            }
        });
 
        $el.onkeyup = this.rules;
    }
    
    /**
     * Build DIV
     */
    this.buildDIV = ( $el ) => {

        if($el.classList.contains('wysiwyg'))
        {
            Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
                get() {
                    $el.value
                    return $el.value;
                },
                set( v ) {

                    if( v == 'makeInvalid' )
                    {
                        $el.classList.add('is-invalid');
                        return true;
                    }
                    
                    if( v == 'makeValid' )
                    {
                        $el.classList.remove('is-invalid');
                        return true;
                    }

                    $el.value = v;
                }
            });
        }
        else if($el.getAttribute('contenteditable'))
        {
            Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
                get() {

                    let v = $el.innerHTML;

                    v = v.replaceAll('<div>','');
                    v = v.replaceAll('</div>','\n');
                    v = v.replaceAll('<br>','\n');

                    return v;
                },
                set( v ) {
                    $el.innerHTML = v;
                }
            });
        }
        else
        {
            Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
                get() {
                    return $el.value;
                },
                set( v ) {

                    if( v == 'makeInvalid' )
                    {
                        $el.classList.add('is-invalid');
                        return true;
                    }
                    
                    if( v == 'makeValid' )
                    {
                        $el.classList.remove('is-invalid');
                        return true;
                    }

                    let to = $el.getAttribute('to');
                    if( to != null  && $el.parentNode.querySelector(to))
                    {
                        if( $el.querySelector('[value="'+v+'"]') != undefined )
                            $el.parentNode.querySelector(to).innerHTML = $el.querySelector('[value="'+v+'"]').innerHTML;
                        else
                            $el.parentNode.querySelector(to).innerHTML = v;
                    }

                    $el.value = v;
                }
            });
        }
    }
    
    /**
     * Build DIV
     */
    this.buildIMG = ( $el ) => {

        Object.defineProperty( this.parameters, '__'+$el.getAttribute('name'), {
            get() {
                return $el.getAttribute('src');
            },
            set( v ) {
                
                if( v == 'makeInvalid' )
                {                
                    return true;
                }
                
                if( v == 'makeValid' )
                {                
                    return true;
                }

                $el.setAttribute('src', v);
                $el.src = v;
            }
        });
    }

    /**
     * Set the valores of parameters
     */
    this.buildActions = () => {

        $scope.addEventListener('click', (e) => {

            let action =  e.target.getAttribute('actionRun');
            if( action != null && _this.config.actions[ action ] != undefined )
                _this.config.actions[ action ]( _this, e.target );
        });

        let $els = $scope.querySelectorAll('[action]');
        for (let i = 0; i < $els.length; i++) {

            let $el = $els[i];
            let action = $el.getAttribute('action');
            
            if( _this.config.actions[ action ] != undefined )
            {
                let actionType =  $el.getAttribute('actionType');
                if(actionType != null)
                {
                    $el.addEventListener( actionType, (e) => {
                        _this.config.actions[ action ]( _this, $el, e );
                    });
                }
                else
                {
                    if($el.nodeName.toUpperCase() == 'SELECT' || $el.type == 'hidden')
                        $el.onchange = () => { _this.config.actions[ action ]( _this, $el ) };
                    else
                        $el.onclick = () => { _this.config.actions[ action ]( _this, $el ) };
                }
            }
        }
        
        $els = $scope.querySelectorAll('[upload]');
        for (let i = 0; i < $els.length; i++) {

            let $el = $els[i];
            let action = $el.getAttribute('upload');

            if( _this.config.actions[ action ] != undefined )
                $el.onchange = () => { _this.config.actions[ action ]( _this, $el ) };
        }
    }

    /**
     * Create count to inputs
     */
    this.buildCounts = function()
    {
        let $counts = $scope.querySelectorAll('[maxlength]');
        for (let i = 0; i < $counts.length; i++)
        {
            $counts[i].classList.add('countUp');

            let $s = components.createSpan($counts[i].value.length+'/'+$counts[i].getAttribute('maxlength'), 'length-word');
            $counts[i].parentNode.appendChild($s);
            
            $counts[i].addEventListener('keyup', function(){
                $s.innerHTML = this.value.length+'/'+this.getAttribute('maxlength');
            });
            
            $counts[i].change = function(){
                $s.innerHTML = this.value.length+'/'+this.getAttribute('maxlength');
            };
        }
    }

    /**
     * Verified rules
     */
    this.rules = () => {

        let $els = $scope.querySelectorAll('[rule]');

        for (let i = 0; i < $els.length; i++) {

            let $el = $els[i];
            let rule = $el.getAttribute('rule');
            let form_el = $el.querySelectorAll('[name]');

            if( _this.config.rules[ rule ] != undefined && _this.config.rules[ rule ]( _this.parameters ) )
            {
                $el.classList.remove('d-none');
                for (let j = 0; j < form_el.length; j++)
                    form_el[j].removeAttribute('disabled');
            }
            else
            {
                $el.classList.add('d-none');
                for (let j = 0; j < form_el.length; j++)
                    form_el[j].setAttribute('disabled', '');
            }
        }
        
        $els = $scope.querySelectorAll('[ruleExist]');
        for (let i = 0; i < $els.length; i++) {

            let $el = $els[i];
            let rule = $el.getAttribute('ruleExist');
            let form_el = $el.querySelectorAll('[name]');

            if( _this.config.rules[ rule ] != undefined )
            {
                if( _this.config.rules[ rule ]( _this.parameters ) )
                {
                    $el.classList.remove('d-none');
                    for (let j = 0; j < form_el.length; j++)
                        form_el[j].removeAttribute('disabled');
                }
                else
                {
                    $el.classList.add('d-none');
                    for (let j = 0; j < form_el.length; j++)
                        form_el[j].setAttribute('disabled', '');
                }
            } 
        }

        this.verified();

        if( this.config.process != undefined )
            this.config.process( _this );
    }

    /**
     * Verified CSS
     */
    this.verified = () => {

        let $els = $scope.querySelectorAll('[verified]');

        for (let i = 0; i < $els.length; i++) {

            let $el = $els[i];
            let verified = $el.getAttribute('verified');

            if( _this.config.verified == undefined || (_this.config.verified[ verified ] != undefined && _this.config.verified[ verified ]( _this.parameters, $el )) )
            {
                $el.classList.remove('d-none');
            }
            else
            {
                $el.classList.add('d-none');
            }
        }
    }
    
    /**
     * Verified rules
     */
    this.validate = ( error ) => {

        let $els = $scope.querySelectorAll('[required]');
        let flag = true;

        for (let i = 0; i < $els.length; i++) {

            let $el = $els[i];
            let name = $el.getAttribute('name');
            $el.classList.remove('is-invalid');

            if( $el.parentNode.classList.contains('d-none') )
            {}
            else
            {
                let v = _this.parameters['__'+name];
                if( v == undefined &&  
                    ( 
                        ( Array.isArray($el.value) && $el.value.length == 0) || 
                        ( !Array.isArray($el.value) && $el.value.trim() == '' && $el.value == false )
                    )
                )
                {
                    if(error == undefined || error == true)
                        $el.classList.add('is-invalid');
                    
                    if( $el.getAttribute('disabled') == undefined )
                        flag = false;
                }
                else if( v != undefined &&  
                    ( 
                        ( Array.isArray(v) && v.length == 0) || 
                        ( !Array.isArray(v) && v.trim() == '' && _this.parameters['__'+name] == false )
                    )
                )
                {
                    if(error == undefined || error == true)
                        $el.classList.add('is-invalid');
                    
                    if( $el.getAttribute('disabled') == undefined )
                        flag = false;
                }
                
            }
        }

        return flag;
    }

    /**
     * Process form
     */
    this.processForm = () => {

        let $els = $scope.querySelectorAll('[name]');
        let data = {};

        for (let i = 0; i < $els.length; i++)
        {
            let $el = $els[i];
            let name = $el.getAttribute('name');

            if( $el.getAttribute('disabled') == undefined && $el.getAttribute('nosend') == undefined )
                data[ name ] = _this.parameters['__'+name];
        }

        return data;
    }

    /**
     * Submit Form
     */
    this.submit = () => {

        if( !_this.validate() )
        {
            components.createToast( _this.config.lang.errorTitle, _this.config.lang.errorMessage);
            return false;
        }

        if( _this.submitStart == true )
            return false;

        //_this.submitStart = true;
        axios.post( _this.config.url, _this.processForm() ).then((response) => 
        {
            components.createToast( _this.config.lang.successTitle, _this.config.lang.successMessage);
            setTimeout(() => { window.location.href= _this.config.goTo; }, 3000);
            
        }).catch((err) => {
            components.createToast( _this.config.lang.errorTitle, err.message);
            _this.submitStart = false;
        });
    }

    _this.construtor();
}
