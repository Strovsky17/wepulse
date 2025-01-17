<div class='panel-side panel-assets-history'>

    <div class='panel-header'>
        <h4>{!!__("menu.history")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='row'>

            <!-- Equipment -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.equipment') !!}</label>
                <input type="text" class="form-control" name='equipment' placeholder='{!!__("form.equipmentPlaceholder")!!}' required />
            </div>

             <!-- Category -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.category') !!}</label>
                <span rule='view'></span>
                <div WepulseDrop name='category_id' action='update' required to='span' rule='edit'>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value=''>Nenhuma</div>
                        @foreach($categories as $c)
                        <div value='{{$c->id}}'>{{$c->name}}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Register -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.register') !!}</label>
                <input type="text" class="form-control" name='register' placeholder='{!!__("form.registerPlaceholder")!!}' required />
            </div>

            <!-- Date -->
            <div class='form-group col-md-12'>
                <label>{!! __('form.date') !!}</label>
                <input type="date" class="form-control" name='date' placeholder='{!!__("form.datePlaceholder")!!}' required />
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
            window.pAssetsHistory = new PanelAssetsHistory( document.querySelector('.panel-assets-history') );
        })
    </script>
</div>