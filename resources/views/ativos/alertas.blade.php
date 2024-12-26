@extends('page')
@extends('misc.sidebar')
@extends('misc.topbar')

@section('content')

    <div class='panel form row'>
    
        <div class='form-group col-md-8'>
            <label>{!! __('alert.type') !!}</label>
            <input type="text" class="form-control" name='type' placeholder='{!!__("alert.typePlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-4'>
            <label>{!! __('register.date') !!}</label>
            <input type="date" class="form-control" name='date' placeholder='DD/MM/YYYY' required>
        </div>

        <div class='form-group col-md-6'>
            <label>{!! __('alert.active') !!}</label>
            <input type="text" class="form-control" name='active' placeholder='{!!__("alert.activePlaceHolder")!!}' required>
        </div>
      
        <div class='form-group col-md-6'>
            <label>{!! __('alert.category') !!}</label>
            <input type="text" class="form-control" name='category' placeholder='{!!__("active.categoryPlaceHolder")!!}' required>
        </div>

    </div>

@endsection