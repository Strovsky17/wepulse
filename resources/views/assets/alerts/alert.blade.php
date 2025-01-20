<div class='panel-side panel-assets-alert'>

    <div class='panel-header'>
        <h4>{!!__("menu.createAlert")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='row'>

            <!-- Asset -->
            <div class='form-group col-md-12' >
                <label>{!! __('form.asset') !!}</label>
                <input type='hidden' name='asset' value='1' />
                <div WepulseDrop name='asset_id' action='update'>
                    <div>
                        <input value/>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value=''></div>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.description') !!}</label>
                <input type="text" class="form-control" name='description' required />
            </div>
                   
            <!-- Obs -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.obs') !!}</label>
                <textarea class="form-control" name='obs'> </textarea>
            </div>

            <!-- Status -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.status') !!}</label>
                <div WepulseDrop name='status' action='update'>
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