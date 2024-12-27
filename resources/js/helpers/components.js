window.components = {

    // Create DIV
    createDiv: function( cls, txt, callback )
    {
        let $div = document.createElement('DIV');
        
        if( cls != undefined )
            $div.className = cls;
        
        if( txt != undefined )
            $div.innerHTML = txt;

        if( callback != undefined )
            $div.onclick = callback;

        return $div;
    },
    
    // Create H
    createH: function( H, text, cls )
    {
        let $h = document.createElement('H'+H);
        $h.innerHTML = text;
        
        if( cls != undefined )
            $h.className = cls;

        return $h;
    },
    
    // Create H
    createI: function( cls, text )
    {
        let $i = document.createElement('i');
        $i.className = cls;

        if( text != undefined)
            $i.innerHTML = text;

        return $i;
    },
   
    // Create Label
    createLabel: function( text, cls )
    {
        let $label = document.createElement('LABEL');
        $label.innerHTML = text;
        
        if( cls != undefined )
            $label.className = cls;

        return $label;
    },
    
    // Create Span
    createSpan: function( text, cls )
    {
        let $span = document.createElement('SPAN');
        $span.innerHTML = text;
        
        if( cls != undefined )
            $span.className = cls;

        return $span;
    },
    
    // Create Button
    createButton: function( text, cls, callback )
    {
        let $button = document.createElement('BUTTON');
        $button.innerHTML = text;
        
        if( cls != undefined )
            $button.className = cls;
        
        if( callback != undefined )
            $button.onclick = callback;

        return $button;
    },
    
    // Create input
    createInput: function( type, cls, properties )
    {
        let $input = document.createElement('INPUT');        
        $input.type = type;
        
        if( cls != undefined )
            $input.className = cls;
        
        if(properties != undefined)
        {
            if( properties.name != undefined )
                $input.name = properties.name;    
        
            if( properties.placeholder != undefined )
                $input.placeholder = properties.placeholder;    
            
            if( properties.min != undefined )
                $input.min = properties.min;    
            
            if( properties.maxlength != undefined )
                $input.setAttribute('maxlength',properties.maxlength);
            
            if( properties.command != undefined )
                $input.setAttribute('command', true);
            
            if( properties.value != undefined )
                $input.setAttribute('value', properties.value);
        }

        return $input;
    },
    
    // Create A
    createA: function( label, cls, properties )
    {
        let $a = document.createElement('A');        
        $a.innerHTML = label;
        
        if( cls != undefined )
            $a.className = cls;
        
        if(properties != undefined)
        {      
            if( properties.target != undefined )
                $a.setAttribute('target',properties.target);
            
            if( properties.href != undefined )
                $a.setAttribute('href',properties.href);
        }

        return $a;
    },
    
    // Create input
    createTextarea: function( cls, properties )
    {
        let $t = document.createElement('TEXTAREA');
        
        if( cls != undefined )
            $t.className = cls;
        
        if(properties != undefined)
        {
            if( properties.name != undefined )
                $t.name = properties.name;      
            
            if( properties.maxlength != undefined )
                $t.setAttribute('maxlength',properties.maxlength);
        }
       
        return $t;
    },

    // Create select
    createSelect: function( cls, options )
    {
        let select = document.createElement('SELECT');
        
        if( cls != undefined )
            select.className = cls;

        for (let i = 0; i < options.length; i++)
        {
            if( options[i].value != undefined )
                select.appendChild(components.createOption( options[i].value, options[i].label ));
            else
                select.appendChild(components.createOption( options[i], options[i] ));
        }

        return select;
    },

    // Create select
    createOption: function( value, label )
    {
        let o = document.createElement( 'option' );
        o.value = value;
        o.innerHTML = label;

        return o;
    },
    
    // Create select
    createTable: function( cls )
    {
        let t = document.createElement( 'table' );
        t.thead = document.createElement('thead');
        t.tbody = document.createElement('tbody');

        t.appendChild(t.thead);
        t.appendChild(t.tbody);

        if( cls != undefined )
            t.className = cls;

        return t;
    },
    
    // Create select
    createForm: function( method, url )
    {
        let f = document.createElement( 'form' );
        
        f.method = method;
        f.url = url;

        return f;
    },

    // Create Group Form without inputs
    createGroupForm: function( label, subtext, cls )
    {
        let gf = components.createDiv('form-group');
        gf.className = gf.className+( cls != undefined ? ' '+cls: '' );
        
        if(label != '' )
            gf.appendChild( components.createLabel(label) );

        if(subtext != '' && subtext != undefined  )
            gf.appendChild( components.createSpan(subtext) );

        return gf;
    },

    // Create POP UP
    createPopUp: function( title, actions )
    {
        let model = components.createDiv('modal');
        let modelDialog = components.createDiv('modal-dialog');
        let modelContent = components.createDiv('modal-content');
        let modelHeader = components.createDiv('modal-header');
        let modelBody = components.createDiv('modal-body');
        let modelLoading = components.createDiv('modal-loading d-none');
        
        model.body = modelBody;
        model.load = modelLoading;
        model.close = function()
        {
            model.remove();
        }

        modelContent.appendChild(modelHeader);
        modelContent.appendChild(modelBody);
        modelContent.appendChild(modelLoading);
        modelDialog.appendChild(modelContent);
        model.appendChild(modelDialog);

        modelHeader.appendChild(components.createH(4, title, 'modal-title'));
        modelHeader.appendChild( components.createButton('', 'btn-close', model.close) );

        // Actions button
        if( actions != undefined)
        {
            let modelFooter = components.createDiv('modal-footer');
            modelContent.appendChild(modelFooter);

            for (let i = 0; i < actions.length; i++)
                modelFooter.appendChild( components.createButton(actions[i].text, actions[i].cls, actions[i].callback) );
        }


        return model;
    },
    
    // Create POP UP
    createConfirmPopUp: function( title, textClose, textConfirm, call  )
    {
        let $popUp = components.createPopUp( title, [
            { text: textClose, cls:'btn btn-default btn-zapify', callback: () => { $popUp.close();  } },
            { text: textConfirm, cls:'btn btn-secondary btn-zapify', callback: () => { call(); $popUp.close();  } }
        ]);

        document.body.appendChild( $popUp );
        $popUp.style.display = 'flex';
        $popUp.classList.add('model-confirm');
    },

    // Create Success Message
    createSuccess: function( text, time )
    {
        let alert = components.createDiv('alert alert-success');
        alert.innerHTML = text;
    
        if( time != undefined)
        {
            setTimeout(function() {
                alert.remove()
            }, time);
        }

        return alert;
    },

    // Create Success Message
    createError: function( text, time )
    {
        let alert = components.createDiv('alert alert-danger');
        alert.innerHTML = text;
    
        if( time != undefined)
        {
            setTimeout(function() {
                alert.remove()
            }, time);
        }

        return alert;
    },

    // Create Success Message
    createAlert: function( text, time )
    {
        let alert = components.createDiv('alert alert-warning');
        alert.innerHTML = text;
    
        if( time != undefined)
        {
            setTimeout(function() {
                alert.remove()
            }, time);
        }

        return alert;
    },
    
    // Create Success Message
    createNote: function( text, time )
    {
        let alert = components.createDiv('alert');
        alert.innerHTML = text;
    
        if( time != undefined)
        {
            setTimeout(function() {
                alert.remove()
            }, time);
        }

        return alert;
    },

    // Create Success Message
    createToast: function( title, text )
    {
        let toastL = document.querySelector('.toast-list');
        if( toastL == undefined )
        {
            toastL = components.createDiv('toast-list');
            document.body.appendChild(toastL);            
        }
        
        let toast = components.createDiv('toast-info');
        toast.appendChild( components.createLabel(title, '') );
        toast.appendChild( components.createSpan(text, '') );

        toastL.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('open');
        },200);
        
        setTimeout(() => {
            toast.classList.add('toastclose');
        },5000);
        
        setTimeout(() => {
            toast.remove();
        },5500);   
    }
}