@extends('page')
@extends('misc.sidebar')
@extends('misc.topbar')

@section('content')

    <div class='panel form row'>
    
        <div class='form-group col-md-8'>
            <label>{!! __('edit.designation') !!}</label>
            <input type="text" class="form-control" name='designation' placeholder='{!!__("edit.designationPlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-4'>
            <label>{!! __('edit.values') !!}</label>
            <input type="date" class="form-control" name='values' placeholder='{!!__("edit.valuesPlaceHolder")!!}' required>
        </div>

    </div>

@endsection