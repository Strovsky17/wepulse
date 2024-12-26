@extends('page')
@extends('misc.sidebar')
@extends('misc.topbar')

@section('content')
    <div class='panel form row'>
    
        <div class='form-group col-md-8'>
            <label>{!! __('register.name') !!}</label>
            <input type="text" class="form-control" name='name' placeholder='{!!__("register.namePlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-4'>
            <label>{!! __('register.image') !!}</label>
            <input type="text" class="form-control" name='image' placeholder='000000000' required>
        </div>

        <div class='form-group col-md-6'>
            <label>{!! __('register.label') !!}</label>
            <input type="text" class="form-control" name='label' placeholder='{!!__("register.labelPlaceHolder")!!}' required>
        </div>
      
        <div class='clearfix'></div>

        <div class='form-group col-md-6'>
            <label>{!! __('register.service') !!}</label>
            <input type="text" class="form-control" name='service' placeholder='{!!__("register.servicePlaceHolder")!!}' required>
        </div>
        
        <div class='form-group col-md-6'>
            <label>{!! __('register.software') !!}</label>
            <input type="text" class="form-control" name='software' placeholder='{!!__("register.softwarePlaceHolder")!!}' required>
        </div>
        
        <div class='form-group col-md-5'>
            <label>{!! __('register.model') !!}</label>
            <input type="text" class="form-control" name='model' placeholder='{!!__("register.modelPlaceHolder")!!}' required>
        </div>
        
        <div class='form-group col-md-2'>
            <label>{!! __('register.ip') !!}</label>
            <input type="text" class="form-control" name='ip' placeholder='0000000000000' required>
        </div>

        <div class='form-group col-md-5'>
            <label>{!! __('register.fqdin') !!}</label>
            <input type="text" class="form-control" name='fqdin' placeholder='{!!__("register.fqdinPlaceHolder")!!}' required>
        </div>
        
        <div class='form-group col-md-6'>
            <label>{!! __('register.producer') !!}</label>
            <input type="text" class="form-control" name='producer' placeholder='{!!__("register.producerPlaceHolder")!!}' required>
        </div>
        
        <div class='form-group col-md-2'>
            <label>{!! __('register.registerdate') !!}</label>
            <input type="date" class="form-control" name='registerdate' placeholder='DD/MM/YYYY' required>
        </div>
        
        <div class='form-group col-md-4'>
            <label>{!! __('register.category') !!}</label>
            <input type="text" class="form-control" name='category' placeholder='{!!__("register.categoryPlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-6'>
            <label>{!! __('register.address') !!}</label>
            <input type="text" class="form-control" name='address' placeholder='{!!__("register.addressPlaceHolder")!!}' required>
        </div>
        
        <div class='form-group col-md-2'>
            <label>{!! __('register.criticality') !!}</label>
            <input type="text" class="form-control" name='criticality' placeholder='{!!__("register.criticalityPlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-4'>
            <label>{!! __('register.risk') !!}</label>
            <input type="text" class="form-control" name='risk' placeholder='{!!__("register.riskPlaceHolder")!!}' required>
        </div>
          
        <div class='form-group col-md-6'>
            <label>{!! __('register.cost') !!}</label>
            <input type="text" class="form-control" name='cost' placeholder='{!!__("register.costPlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-6'>
            <label>{!! __('register.value') !!}</label>
            <input type="text" class="form-control" name='value' placeholder='{!!__("register.valuePlaceHolder")!!}' required>
        </div>
    
        <div class='form-group col-md-12'>
            <label>{!! __('register.description') !!}</label>
            <input type="text" class="form-control" name='description' placeholder='{!!__("register.descriptionPlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-12'>
            <label>{!! __('register.responsable') !!}</label>
            <input type="text" class="form-control" name='responsable' placeholder='{!!__("register.responsablePlaceHolder")!!}' required>
        </div>

    </div>

    <div class='panel form row'>

        <div class='form-group col-md-4'>
            <label>{!! __('register.date') !!}</label>
            <input type="date" class="form-control" name='date' placeholder='DD/MM/YYYY' required>
        </div>
    
        <div class='form-group col-md-8'>
            <label>{!! __('edit.maintenance') !!}</label>
            <input type="text" class="form-control" name='maintenance' placeholder='{!!__("edit.maintenancePlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-12'>
            <label>{!! __('edit.observation') !!}</label>
            <input type="date" class="form-control" name='observation' placeholder='{!!__("edit.observationPlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-6'>
            <label>{!! __('edit.nextmaintenance') !!}</label>
            <input type="text" class="form-control" name='nextmaintenance' placeholder='{!!__("edit.nextmaintenancePlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-6'>
            <label>{!! __('edit.guarantee') !!}</label>
            <input type="text" class="form-control" name='guarantee' placeholder='{!!__("edit.guaranteePlaceHolder")!!}' required>
        </div>

    </div>

@endsection