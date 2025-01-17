<div class='panel-side panel-assets-responsable'>

    <div class='panel-header'>
        <h4>{!!__("menu.responsable")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='row'>

            <!-- Name -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.name') !!}</label>
                <input type="text" class="form-control" name='name' placeholder='{!!__("form.namePlaceholder")!!}' required />
            </div>
        </div>
    </div>

    <div class='footer'>
        <button class='btn btn-primary' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' action='cancel'>{{ __("form.cancel") }}</button>
    </div>

    <div class='load d-none' rule='load'><i class="fa-duotone fa-solid fa-spinner-third"></i></div>
    <input type='hidden' name='load' value='0'/>

    <script>
        window.addEventListener('load', () => {
            window.pAssetsResponsable = new PanelAssetsResponsable( document.querySelector('.panel-assets-responsable') );
        })
    </script>
</div>