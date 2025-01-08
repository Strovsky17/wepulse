
// Toggle
window.WepulseToggle = function( $scope ) {

    /**
     * Contructor the interface
     */
    this.constructor = () => {

        let WepulseToggle = $scope.querySelectorAll('[WepulseToggle]');
        for (let i = 0; i < WepulseToggle.length; i++)
            this.createToggle( WepulseToggle[i] );
    }

    /**
     * Create Toggle
     **/
    this.createToggle = ( toggle ) => {

        if( toggle.value != undefined )
            return;

        // Get options
        let options = toggle.getAttribute('WepulseToggle').split(',');
        if( options.length != 2 )
            options = [ true, false ];

        // Action
        toggle.addEventListener( 'click', () => {
            toggle.classList.toggle('active');
        });

        // Set/Get
        Object.defineProperty( toggle, 'value', {
            get: () => {
                if( toggle.classList.contains('active') )
                    return options[0];

                return options[1];
            },
            set: ( v ) => {
                if( options[0] == v )
                    toggle.classList.add('active');
                else
                    toggle.classList.remove('active');
            }
        });
    }


    this.constructor();

}

// Drop
window.WepulseDrop = function( $scope ) {

    let _this = this;

    /**
     * Contructor the interface
     */
    this.constructor = () => {

        this.auxSearch = '';
        this.auxSearchTime = null;

        let WepulseDrop = $scope.querySelectorAll('[WepulseDrop]');
        for (let i = 0; i < WepulseDrop.length; i++)
            this.createDrop( WepulseDrop[i] );

        document.body.addEventListener('click', () => {

            setTimeout(() => {
                for (let i = 0; i < WepulseDrop.length; i++)
                    WepulseDrop[i].children[0].classList.remove('active');
            }, 100);

            document.body.removeEventListener('keydown', this.searchEvent );
        });
    }

    /**
     * Create Toggle
     **/
    this.createDrop = ( drop ) => {

        if(drop.querySelector('span') != undefined)
            this.createDropSelect( drop );

        if(drop.querySelector('input') != undefined)
            this.createDropSearch( drop );
    }

    /**
     * Create Drop Select FORMAT
     */
    this.createDropSelect = ( drop ) => {

        let span = drop.querySelector('span');

        drop.children[0].onclick = (e) => {
            
            if(  drop.children[0].classList.contains('active') )
            {
                drop.children[0].classList.remove('active');
                document.body.removeEventListener('keydown', this.searchEvent );
            }
            else
            {
                if( document.querySelector('[Wepulsedrop] .active') != undefined)
                    document.querySelector('[Wepulsedrop] .active').classList.remove('active');
                
                drop.children[0].classList.add('active');
                document.body.addEventListener('keydown', this.searchEvent );
            }
            e.stopPropagation();
            e.preventDefault();

            let options = drop.querySelectorAll('[value]');
            for (let i = 0; i < options.length; i++) 
            {
                let o = options[i];
                o.onclick = () => {
                    drop.value2 = o.getAttribute('value');
                    span.innerHTML = o.innerHTML;
                }
            }

            // Close options
            let fn = () => { 
                setTimeout( () => { 
                    drop.children[0].classList.remove('active');
                    document.body.removeEventListener('keydown', this.searchEvent );
                    document.body.removeEventListener('click', fn);
                }, 200)  
            };
            
            document.body.addEventListener('click', fn);
        }

        let options = drop.querySelectorAll('[value]');
        for (let i = 0; i < options.length; i++) 
        {
            let o = options[i];
            
            if( i == 0 )
            {
                drop.value2 = o.getAttribute('value');
                span.innerHTML = o.innerHTML;
            }
        }

        // Set/Get
        Object.defineProperty( drop, 'value', {
            get: () => {
                return drop.value2;
            },
            set: ( v ) => {

                let options = drop.querySelectorAll('[value]');
                for (let i = 0; i < options.length; i++) 
                {
                    let o = options[i];
                    if( o.getAttribute('value') == v )
                    {
                        drop.value2 = o.getAttribute('value');
                        span.innerHTML = o.innerHTML;
                    }
                }
            }
        });
    }

    /**
     * Create Drop Search FORMAT
     */
    this.createDropSearch = ( drop ) => {

        let input = drop.querySelector('input');

        // Search
        let search = ( t ) => {
         
            let value = input.value.toLowerCase();
            let options = drop.querySelectorAll('div[value]');
            for (let i = 0; i < options.length; i++)
            {
                const el = options[i];
                if( t == true || value == '' || el.innerHTML.toLowerCase().search( value ) != -1 )
                    el.classList.remove('d-none');
                else
                    el.classList.add('d-none');
            }
        }

        // Open Search
        input.onfocus = ( e )=> {

            e.stopPropagation();
            e.preventDefault();
            drop.children[0].classList.add('activeX');
            
            let options = drop.querySelectorAll('div[value]');
            for (let i = 0; i < options.length; i++) 
            {
                let o = options[i];
                o.onclick = () => {

                    // MultiSelect
                    if( drop.getAttribute('multiselect') != null )
                    {
                        input.value = '';
                        _this.multiSelectAdd( drop, o.getAttribute('value') );
                    }
                    else
                    {
                        drop.children[0].classList.remove('activeX');
                        drop.value2 = o.getAttribute('value');
                        input.value = o.innerHTML;
                    }
                }
            }

            search( true );
        }
        
        // Close
        input.onblur = ()=> {
            setTimeout(() => {
                drop.children[0].classList.remove('activeX');

                // MultiSelect
                if( drop.getAttribute('multiselect') != null )
                {
                    input.value = '';
                }
                else
                {
                    let o = drop.querySelector('div[value="'+drop.value2+'"]');
                    if( o == undefined || drop.value2 == '')
                    {
                        drop.value2 = '';
                        input.value = '';
                    }
                    else
                    {
                        drop.value2 = o.getAttribute('value');;
                        input.value = o.innerHTML;
                    }
                }
            },200);
        }
        
        // Close
        input.onkeyup = ()=> {
            search( false );
        }

        try 
        {
            // Set/Get
            Object.defineProperty( drop, 'value', {
                get: () => 
                {
                    // MultiSelect
                    if( drop.getAttribute('multiselect') != null )
                        return _this.multiSelectGet(drop)

                    return drop.value2;
                },
                set: ( v ) => 
                {
                    // MultiSelect
                    if( drop.getAttribute('multiselect') != null )
                    {
                        _this.multiSelectSet(drop, v)
                    }
                    else
                    {
                        let options = drop.querySelectorAll('[value]');
                        for (let i = 0; i < options.length; i++) 
                        {
                            let o = options[i];
                            if( o.getAttribute('value') == v )
                            {
                                drop.value2 = o.getAttribute('value');
                                input.value = o.innerHTML;
                            }
                        }
                    }                
                }
            });
        } 
        catch (error) {
        
        }
    }

    /**
     * MultiSelect Add
     */
    this.multiSelectAdd = ( drop, id ) => {

        if( drop.querySelector('[data-id="'+id+'"]') == undefined && drop.querySelector('[value="'+id+'"]') != undefined )
        {
            let div = components.createDiv('mul-select');
            div.innerHTML = drop.querySelector('[value="'+id+'"]').innerHTML;
            div.setAttribute('data-id', id); 

            drop.querySelector('.multiresults').appendChild(div);
            div.onclick = () => { div.remove(); }
        }
    }
    
    /**
     * MultiSelect Get Data
     */
    this.multiSelectGet = ( drop ) => {

        let data = [];
        let multi = drop.querySelectorAll('[data-id]')
        for (let i = 0; i < multi.length; i++)
            data.push(multi[i].getAttribute('data-id'));

        return data;
    }
    
    /**
     * MultiSelect Get Data
     */
    this.multiSelectSet = ( drop, v ) => {

        drop.querySelector('.multiresults').innerHTML = '';
        for (let i = 0; i < v.length; i++)
            this.multiSelectAdd(drop, v[i]);
    }

    /**
     * Search drop
     */
    this.searchEvent = ( e ) => {

        if( _this.auxSearchTime != null )
            clearInterval(_this.auxSearchTime);

        _this.auxSearchTime = setInterval( () => {
            _this.auxSearch = '';
        },300);
        
        if( e.code != e.key )
            _this.auxSearch += e.key;

        let WepulseDrop = $scope.querySelector('[WepulseDrop] .active');
        if(WepulseDrop)
        {
            for (let i = 0; i < WepulseDrop.nextElementSibling.children.length; i++) 
            {
                let v = WepulseDrop.nextElementSibling.children[i];
                let text = v.innerHTML;
                
                if( text.toLowerCase().startsWith( _this.auxSearch.toLowerCase() ))
                {
                    WepulseDrop.nextElementSibling.scrollTo({ top: v.offsetTop});
                    return true;
                }        
            }
        }
    }

    this.constructor();

}

// Drag
window.WepulseDrag = function( $scope ) {

    /**
     * Contructor the interface
     */
    this.constructor = () => {

        let WepulseDrag = $scope.querySelectorAll('[WepulseDrag]');
        for (let i = 0; i < WepulseDrag.length; i++)
            this.createDrag( WepulseDrag[i] );
    }

    // Create Drag
    this.createDrag = ( sortableList ) => {

        sortableList.onmouseover = (e) => {
            const items = sortableList.querySelectorAll("[draggable]");
            items.forEach(item => {
                item.ondragstart = () => {
                    // Adding dragging class to item after a delay
                    setTimeout(() => item.classList.add("dragging"), 0);
                }

                // Removing dragging class from item on dragend event
                item.ondragend = () => item.classList.remove("dragging");
            });
        };
       
        sortableList.onclick = sortableList.onmouseover 

        sortableList.addEventListener("dragover", (e) => {

            e.preventDefault();
            const draggingItem = sortableList.querySelector(".dragging");

            // Getting all items except currently dragging and making array of them
            let siblings = [...sortableList.querySelectorAll("[draggable]:not(.dragging)")];


            // Finding the sibling after which the dragging item should be placed
            let nextSibling = siblings.reduce(
                (closest, child) => {
                    const box =
                        child.getBoundingClientRect();
                    const offset =
                        e.clientY - box.top - box.height / 2;
                    if (
                        offset < 0 &&
                        offset > closest.offset) {
                        return {
                            offset: offset,
                            element: child,
                        };} 
                    else {
                        return closest;
                    }},
                {
                    offset: Number.NEGATIVE_INFINITY,
                }
            ).element
            
            sortableList.insertBefore(draggingItem, nextSibling);
        });

        sortableList.addEventListener("dragenter", e => e.preventDefault());
    }

    this.constructor();

}

// Init Textarea
window.WepulseWYSIWYG = function( $scope )
{
    let wysiwyg = $scope.querySelectorAll(".wysiwyg");
    wysiwyg.forEach(element => { new WYSIWYG(element); });
}

window.WYSIWYG = function( $scope )
{
    let _this = this;

    this.constructor = () => {

        this.maxlength = $scope.getAttribute('tmaxlength');
        this.emojis = $scope.querySelector('.emojis');

        this.initIframe();
        this.initActions();
        this.initProp();

        this.setInfo();
    }

    // Init iframe edit mode
    this.initIframe = () => {

        let linkFont = document.createElement('link');
        linkFont.setAttribute('rel', "stylesheet");
        linkFont.setAttribute('href', "https://fonts.cdnfonts.com/css/inter");
        
        let linkStyle = document.createElement('style');
        linkStyle.innerHTML = `
            ul { padding-left: 10px; margin: 0; }
            ol { padding-left: 10px; margin: 0; }
            blockquote { border-left: 2px solid #8899A8; margin: 0; padding-left: 10px; color: #8899A8;}
            code { background-color: rgba(0,0,0,.1); color: #8899A8; font-size: 14px; padding: 2px 5px }
        `;

        this.iframe = $scope.querySelector('iframe');
        this.iframe.contentDocument.designMode = 'on';

        this.iframe.contentDocument.head.appendChild(linkFont);
        this.iframe.contentDocument.head.appendChild(linkStyle);
        this.iframe.contentDocument.body.style.fontFamily = '"Inter", sans-serif';
        this.iframe.contentDocument.body.style.fontSize = '14px';

        this.bold = $scope.querySelector('.bold');
        this.italic = $scope.querySelector('.italic');
        this.strikethrough = $scope.querySelector('.strikethrough');
        this.insertUnorderedList = $scope.querySelector('.insertUnorderedList');
        this.insertOrderedList = $scope.querySelector('.insertOrderedList');
        this.formatBlock = $scope.querySelector('.formatBlock');
        this.code = $scope.querySelector('.code');
        this.event = $scope.querySelector('.event');
    }

    // Init Actions
    this.initActions = () => {

        // Set actions options
        let actions = $scope.querySelectorAll('[a]');
        actions.forEach( el => {
            
            let a = el.getAttribute('a');
            el.onclick = () => {

                if(a == 'formatBlock')
                {
                    _this.iframe.contentDocument.execCommand("formatBlock", false, "<blockquote>")
                    _this.iframe.focus();
                    _this.setInfo();
                }
                else if(a == 'code')
                {
                    _this.iframe.contentDocument.execCommand("insertHTML", false, "<code>"+ _this.iframe.contentDocument.getSelection()+"</code>")
                    _this.iframe.focus();
                    _this.setInfo();
                }
                else if(a == 'emojis')
                {
                    _this.emojis.classList.toggle('d-none');
                    _this.iframe.focus();
                    return;
                }
                else if( a == 'insertUnorderedList' || a == 'insertOrderedList')
                {
                    _this.iframe.contentDocument.execCommand(a);
                    _this.iframe.focus();
                    _this.setInfo();
                }
                else
                {
                    _this.iframe.contentDocument.execCommand(a);

                    if( el.classList.contains('active') )
                    {
                        _this.iframe.focus();
                        _this.setInfo();
                        el.classList.remove('active')
                    }
                    else
                    {
                        _this.iframe.focus();
                        _this.setInfo();
                        el.classList.add('active')
                    }
                }
            }
        });
        
        // Set actions options        
        this.emojis.querySelectorAll('span').forEach( el => {
            el.onclick = () => {

                _this.iframe.contentDocument.execCommand("insertText", false, el.innerHTML);
                _this.iframe.focus();
                _this.setInfo();
            }
        });
        
        this.iframe.contentDocument.body.addEventListener("keydown", (e) => {

            if(e.keyCode == 13)
            {
                _this.iframe.contentDocument.execCommand('removeformat');

                if( ( e.shiftKey == false || e.ctrlKey == false ) && _this.event != undefined )
                {
                    e.preventDefault();
                    _this.event.click();
                }
            }
        });
        
        this.iframe.contentDocument.body.addEventListener("keyup", () => { 
            _this.setInfo();
        });
       
        this.iframe.contentDocument.body.addEventListener("click", () => { 
            _this.setInfo();
        });

        this.iframe.contentDocument.body.addEventListener("paste", function(e) {
            
            // cancel paste
            e.preventDefault();
        
            // get text representation of clipboard
            let text = (e.originalEvent || e).clipboardData.getData('text/plain');
            
            text = text.replace(/<br>/g, '\n');
            text = text.replace(/<[^>]*>/g, '');
            text = new window.WepulseText(text).transformHTML();

            _this.iframe.contentDocument.execCommand("insertHTML", false, text);
        });
    }
    
    // Init Actions
    this.initProp = () => {

        Object.defineProperty( $scope, 'value', {
            get() {

                let text = _this.iframe.contentDocument.body.innerHTML;

                if(text == '<br>')
                    return '';

                text = text.replaceAll('<b><br></b>','<br>');
                text = text.replaceAll('<i><br></i>','<br>');
                text = text.replaceAll('<s><br></s>','<br>');
                text = text.replaceAll('<div><br></div>','<br>');
                text = text.replaceAll('<br></div>','<br>');
                text = text.replaceAll('<div>','');
                text = text.replaceAll('</div>','<br>');

                return new window.WepulseText(text).transformWhatsapp();
            },
            set( v ) {
                _this.iframe.contentDocument.body.innerHTML = new window.WepulseText(v).transformHTML();
                _this.setInfo()
            }
        });
    }

    // Set informations
    this.setInfo = () => {
    
        let text = $scope.value;

        if( $scope.querySelector('.length-word') != undefined )
            $scope.querySelector('.length-word').innerHTML = text.length+'/'+_this.maxlength;
        
        if( $scope.querySelector('.placeholder') != undefined )
        {
            if(text.length == 0)
                $scope.querySelector('.placeholder').classList.remove('d-none');
            else
                $scope.querySelector('.placeholder').classList.add('d-none');
        }

        _this.iframe.style.height = this.iframe.contentDocument.body.offsetHeight + 16 + 'px';
        _this.emojis.classList.add('d-none');

        this.bold.classList.remove('active');
        this.italic.classList.remove('active');
        this.strikethrough.classList.remove('active');
        this.insertUnorderedList.classList.remove('active');
        this.insertOrderedList.classList.remove('active');
        this.formatBlock.classList.remove('active');
        this.code.classList.remove('active');

        // See active bottom
        let t = _this.iframe.contentDocument.getSelection();
        if( t != null)
        {
            let p = t.focusNode;
            if( p != null )
                p = p.parentNode;

            while ( p != null && p.nodeName != 'BODY' ) 
            {
                if( p.nodeName == 'B')
                    this.bold.classList.add('active');
                else if( p.nodeName == 'I')
                    this.italic.classList.add('active');
                else if( p.nodeName == 'STRIKE')
                    this.strikethrough.classList.add('active');
                else if( p.nodeName == 'UL')
                    this.insertUnorderedList.classList.add('active');
                else if( p.nodeName == 'OL')
                    this.insertOrderedList.classList.add('active');
                else if( p.nodeName == 'BLOCKQUOTE')
                    this.formatBlock.classList.add('active');
                else if( p.nodeName == 'CODE')
                    this.code.classList.add('active');
                /*else
                    console.log(p.nodeName)*/

                p = p.parentNode;
            }
        }
    }

    this.constructor();
}