window.Panel = function( panel )
{
    //new ZapifyDrop( panel.$scope );
    //new ZapifyWYSIWYG( panel.$scope  );

    // Init Form mode
    panel.zForm = new PForm( panel.$scope, {
        rules: panel.rules,
        actions: panel.actions,
        process: panel.process
    });

    panel.parameters = panel.zForm.parameters;
    panel.ruleDisplay = panel.zForm.rules;

    // Open template
    panel.open = ( data, successCallBack, closeCallBack ) => {

        panel.$scope.classList.add('open');
        
        panel.successCallBack = successCallBack;
        panel.closeCallBack = closeCallBack;
        panel.closeCallBack2 = closeCallBack;

        // Open with display options
        if( panel.openDisplay != undefined )
            panel.openDisplay( data )
    }
    
    // Open template
    panel.show = () => {
        panel.$scope.classList.remove('d-none');
    }
   
    // Open template
    panel.close = () => {
        panel.$scope.classList.remove('open');
    
        // Open with display options
        if( panel.closeCallBack != undefined )
        {
            panel.closeCallBack = undefined;
            panel.successCallBack = undefined;

            panel.closeCallBack2();
        }

        panel.closeCallBack = undefined;
        panel.closeCallBack2 = undefined;
        panel.successCallBack = undefined;

        // Open with display options
        if( panel.closeDisplay != undefined )
            panel.closeDisplay()
    }

    // Open template
    panel.hide = () => {
        panel.$scope.classList.add('d-none');
    }
}