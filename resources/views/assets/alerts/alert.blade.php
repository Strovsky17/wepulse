<div class='panel-side panel-assets-alert'>

    <div class='panel-header'>
        <h4>{!!__("menu.createAlert")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='row'>

            <!-- AlertType -->
            <div class='form-group col-md-12'>
            <label>{!! __('form.alertType') !!}</label>
                <div WepulseDrop name='alert' action='update'>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value='input'>{!! __('form.input') !!}</div>
                    </div>
                </div>
            </div>
            
            <!-- Asset -->
            <div class='form-group col-md-12'>
            <label>{!! __('form.asset') !!}</label>
                <div WepulseDrop name='asset' action='update'>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value='input'>{!! __('form.input') !!}</div>
                    </div>
                </div>
            </div>
                    
            <!-- Category -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.category') !!}</label>
                <div WepulseDrop name='category' action='update'>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value='input'>{!! __('form.input') !!}</div>
                    </div>
                </div>
            </div>

            <!-- Date -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.alertDate') !!}</label>
                <input type="date" class="form-control" name='date' placeholder='00/00/0000' required />
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
            window.pAssetsAlert = new PanelAssetsAlert( document.querySelector('.panel-assets-alert') );
        })
    </script>
</div>