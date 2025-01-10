<div class='panel-side panel-assets-field'>

    <div class='panel-header'>
        <h4>{!!__("menu.personalField")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='row'>

            <!-- Name -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.name') !!}</label>
                <input type="text" class="form-control" name='name' placeholder='{!!__("form.namePlaceholder")!!}' required />
            </div>
            
            <!-- Description -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.description') !!}</label>
                <input type="text" class="form-control" name='description' placeholder='{!!__("form.descriptionPlaceholder")!!}' required />
            </div>
                    
            <!-- Type -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.type') !!}</label>
                <div WepulseDrop name='type' action='update'>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value='input'>{!! __('form.input') !!}</div>
                        <div value='textarea'>{!! __('form.textarea') !!}</div>
                        <div value='date'>{!! __('form.date') !!}</div>
                        <div value='checkbox'>{!! __('form.checkbox') !!}</div>
                        <div value='radiobutton'>{!! __('form.radiobutton') !!}</div>
                        <div value='file'>{!! __('form.file') !!}</div>
                        <div value='toggle'>{!! __('form.toggle') !!}</div>
                        <div value='dropdown'>{!! __('form.dropdown') !!}</div>
                    </div>
                </div>
            </div>

            <!-- required -->
            <div class='form-group col-12 mb-0'>
                <label>{!! __('form.required') !!}</label>
            </div>
            <div class='form-group col-10'>
                <span>{!! __('form.requiredPlaceholder') !!}</span>
            </div>
            <div class='form-group col-2'>        
                <div name='required' WepulseToggle='1,0'></div>
            </div>

            <!-- Values -->
            <div class='form-group col-12 mb-0' rule='needValues'>
                <label>{!! __('form.values') !!}</label>
            </div>
            <div class='form-group col-12 fields-values' rule='needValues'>
                <div class="form-input-action mb-2">
                    <input type="text" class="form-control" name="values[]" required="">
                    <i class="fa-thin fa-trash-can" actionrun="remove"></i>
                </div>
            </div>
            <div class='form-group col-12' rule='needValues'>
                <button class='btn btn-primary' action='add'><i class='fa-thin fa-plus'></i> {{ __("form.add") }}</button>        
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
            window.pAssetsField = new PanelAssetsField( document.querySelector('.panel-assets-field') );
        })
    </script>
</div>