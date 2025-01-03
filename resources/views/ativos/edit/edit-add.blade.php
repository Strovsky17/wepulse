<div class='panel form row panel-geraledit-edit'>

<div class='panel-header'>
        <h2>{!!__("register.add")!!}</h2>

        <button class='btn btn-primary' rule='save' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' rule='edit' action='edit'>{{ __("form.edit") }}</button>
    </div>
    <div class='form-group col-md-7'>
        <label>{!! __('register.designation') !!}</label>
        <input type="text" class="form-control" name='date' placeholder='{!!__("register.designationPlaceHolder")!!}' required>
    </div>

    <div class='form-group col-md-5'>
        <label>{!! __('register.values') !!}</label>
        <input type="text" class="form-control" name='maintenance' placeholder='{!!__("register.valuesPlaceHolder")!!}' required>
    </div>
</div>