<div class='panel-side panel-assets-event'>

    <div class='panel-header'>
        <h4>{!!__("menu.event")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='row'>

            <!-- Asset -->
            <div class='form-group col-md-12' rule='asset'>
                <label>{!! __('form.asset') !!}</label>
                <input type='hidden' name='asset' value='1' />
                <div WepulseDrop name='asset_id' action='update' required>
                    <div>
                        <input value/>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value=''></div>
                    </div>
                </div>
            </div>

            <!-- Date -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.date') !!}</label>
                <input type="date" class="form-control" name='date' placeholder='' required />
            </div>
            
            <!-- Who -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.who') !!}</label>
                <input type="text" class="form-control" name='who' placeholder='' required />
            </div>
            
            <!-- description -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.sortDescription') !!}</label>
                <input type="text" class="form-control" name='description' required />
            </div>
            
            <!-- description -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.obs') !!}</label>
                <textarea class="form-control" name='obs'> </textarea>
            </div>

            <!-- nextEvent -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.nextEvent') !!}</label>
                <input type="date" class="form-control" name='next' placeholder='' />
            </div>

            <!-- guarantee -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.guarantee') !!}</label>
                <input type="date" class="form-control" name='guarantee' placeholder='' />
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
            window.pAssetsEvent = new PanelAssetsEvent( document.querySelector('.panel-assets-event') );
        })
    </script>
</div>