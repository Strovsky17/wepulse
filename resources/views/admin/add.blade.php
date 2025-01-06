<div class='panel-side form panel-client-add'>

    <div class='panel-header'>
        <h4>{!!__("menu.client")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='form-group col-md-12'>
            <label>{!! __('profile.name') !!}</label>
            <input type="text" class="form-control" name='name' placeholder='{!!__("profile.namePlaceHolder")!!}' required />
        </div>
    </div>

    <div class='footer'>
        <button class='btn btn-primary' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' action='cancel'>{{ __("form.cancel") }}</button>
    </div>

    <div class='load' rule='load'><i class="fa-duotone fa-solid fa-spinner-third"></i></div>
    <input type='hidden' name='load' value='0'/>
    
    <script>
        window.addEventListener('load', () => {
            window.pClientAdd = new PanelClientAdd( document.querySelector('.panel-client-add') );
        })
    </script>
</div>