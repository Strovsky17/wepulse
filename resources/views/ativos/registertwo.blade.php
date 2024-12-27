<div class='panel form row panel-geralregister-registertwo'>

<div class='panel-header'>
        <h2>{!!__("register.lastmaintenance")!!}</h2>

        <button class='btn btn-primary' rule='save' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' rule='edit' action='edit'>{{ __("form.edit") }}</button>
    </div>
    <div class='form-group col-md-4'>
        <label>{!! __('register.date') !!}</label>
        <input type="date" class="form-control" name='date' placeholder='DD/MM/YYYY' required>
    </div>

    <div class='form-group col-md-8'>
        <label>{!! __('register.maintenance') !!}</label>
        <input type="text" class="form-control" name='maintenance' placeholder='{!!__("register.maintenancePlaceHolder")!!}' required>
    </div>

    <div class='form-group col-md-12'>
        <label>{!! __('register.observation') !!}</label>
        <input type="text" class="form-control" name='observation' placeholder='{!!__("register.observationPlaceHolder")!!}' required>
    </div>

    <div class='form-group col-md-6'>
        <label>{!! __('register.nextmaintenance') !!}</label>
        <input type="text" class="form-control" name='nextmaintenance' placeholder='{!!__("register.nextmaintenancePlaceHolder")!!}' required>
    </div>

    <div class='form-group col-md-6'>
        <label>{!! __('register.guarantee') !!}</label>
        <input type="text" class="form-control" name='guarantee' placeholder='{!!__("")!!}' required>
    </div>

</div>
</div>