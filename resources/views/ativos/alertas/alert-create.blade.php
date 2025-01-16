<div class='panel form row panel-geralalerts-alerts '>

<div class='panel-header'>
        <h2>{!!__("register.createAlert")!!}</h2>

        <button class='btn btn-primary' rule='save' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' rule='edit' action='edit'>{{ __("form.edit") }}</button>
    </div>
    <div class='form-group col-md-9'>
        <label>{!! __('register.alertType') !!}</label>
        <input type="text" class="form-control" name='date' placeholder='{!!__("register.alertTypePlaceHolder")!!}' required>
    </div>

    <div class='form-group col-md-3'>
        <label>{!! __('register.alertDate') !!}</label>
        <input type="date" class="form-control" name='maintenance' placeholder='DD/MM/YYYY' required>
    </div>

    <div class='form-group col-md-6'>
        <label>{!! __('register.alertActive') !!}</label>
        <input type="text" class="form-control" name='observation' placeholder='{!!__("register.alertActivePlaceHolder")!!}' required>
    </div>

    <div class='form-group col-md-6'>
        <label>{!! __('register.alertCategory') !!}</label>
        <input type="text" class="form-control" name='nextmaintenance' placeholder='{!!__("register.alertCategoryPlaceHolder")!!}' required>
    </div>
</div>
