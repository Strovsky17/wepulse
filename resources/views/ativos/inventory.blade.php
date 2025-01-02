@extends('page')
@extends('misc.sidebar', [ "page" => "inventory", "subpage" => "" ])
@extends('misc.topbar', ["title" => __('menu.inventory')])

@section('content')

<div class='panel form row panel-profile-info'>

    <div class='panel-header'>
        <h2>{!!__("register.activeName")!!}</h2>

        <button class='btn btn-primary' rule='save' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' rule='edit' action='edit'>{{ __("form.edit") }}</button>
    </div>
    
    <div class='form-group col-md-6'>
        <label>{!! __('register.service') !!}</label>
        <span rule='edit'>{!!__("register.servicePlaceHolder")!!}</span>
        <input type="text" class="form-control" name='service' placeholder='{!!__("register.servicePlaceHolder")!!}' required rule='save' to='span'/>
    </div>

    <div class='form-group col-md-6'>
        <label>{!! __('register.software') !!}</label>
        <span rule='edit'>{!!__("register.softwarePlaceHolder")!!}</span>
        <input type="text" class="form-control" name='software' placeholder='{!!__("register.softwarePlaceHolder")!!}' required rule='save' to='span'/>
    </div>



    <div class='form-group col-md-7'>
        <label>{!!__("register.registerText")!!}
        <h4>{!!__("register.registerText2")!!}</h4>
    </div>

    <div class='form-group col-md-5'>
    </div>
    
    <div class='form-group col-md-5'>
        <label>{!! __('register.model') !!}</label>
        <span rule='edit'>{!!__("register.modelPlaceHolder")!!}</span>
        <input type="text" class="form-control" name='model' placeholder='{!!__("register.modelPlaceHolder")!!}' required rule='save' to='span'/>
    </div>
  
    <div class='form-group col-md-2'>
        <label>{!! __('register.ip') !!}</label>
        <span rule='edit'>0000000000000</span>
        <input type="text" class="form-control" name='ip' placeholder='0000000000000' required rule='save' to='span'/>
    </div>
    
    <div class='form-group col-md-5'>
        <label>{!! __('register.fqdin') !!}</label>
        <span rule='edit'>{!!__("register.fqdinPlaceHolder")!!}</span>  
        <input type="text" class="form-control" name='fqdin' placeholder='{!!__("register.fqdinPlaceHolder")!!}' required rule='save' to='span'/>
    </div>
    
    <div class='form-group col-md-6'>
        <label>{!! __('register.producer') !!}</label>
        <span rule='edit'>{!!__("register.producerPlaceHolder")!!}</span> 
        <input type="text" class="form-control" name='producer' placeholder='{!!__("register.producerPlaceHolder")!!}' required rule='save' to='span'/>
    </div>
    
    <div class='form-group col-md-2'>
        <label>{!! __('register.registerdate') !!}</label>
        <span rule='edit'>DD/MM/YYYY</span> 
        <input type="text" class="form-control" name='registerdate' placeholder='DD/MM/YYYY' required rule='save' to='span'/>
    </div>

    <div class='form-group col-md-4'>
        <label>{!! __('register.category') !!}</label>
        <span rule='edit'>{!!__("register.categoryPlaceHolder")!!}</span> 
        <input type="text" class="form-control" name='category' placeholder='{!!__("register.categoryPlaceHolder")!!}' required rule='save' to='span'/>
    </div>

    <div class='form-group col-md-6'>
        <label>{!! __('register.address') !!}</label>
        <span rule='edit'>{!!__("register.addressPlaceHolder")!!}</span> 
        <input type="text" class="form-control" name='address' placeholder='{!!__("register.addressPlaceHolder")!!}' required rule='save' to='span'/>
    </div>

    <div class='form-group col-md-2'>
        <label>{!! __('register.criticality') !!}</label>
        <span rule='edit'>{!!__("register.criticalityPlaceHolder")!!}</span> 
        <input type="text" class="form-control" name='criticality' placeholder='{!!__("register.criticalityPlaceHolder")!!}' required rule='save' to='span'/>
    </div>

    <div class='form-group col-md-4'>
        <label>{!! __('register.risk') !!}</label>
        <span rule='edit'>{!!__("register.riskPlaceHolder")!!}</span> 
        <input type="text" class="form-control" name='risk' placeholder='{!!__("register.riskPlaceHolder")!!}' required rule='save' to='span'/>
    </div>
    
    <div class='form-group col-md-12'>
        <label>{!! __('register.description') !!}</label>
        <span rule='edit'>{!!__("register.descriptionPlaceHolder")!!}</span> 
        <input type="text" class="form-control" name='description' placeholder='{!!__("description.riskPlaceHolder")!!}' required rule='save' to='span'/>
    </div>

    <div class='form-group col-md-6'>
        <label>{!! __('register.responsable') !!}</label>
        <span rule='edit'>{!!__("register.responsablePlaceHolder")!!}</span> 
        <input type="text" class="form-control" name='responsable' placeholder='{!!__("responsable.riskPlaceHolder")!!}' required rule='save' to='span'/>
    </div>


    <input type='hidden' name='edit' value='0' />
    <script>
        window.addEventListener('load', () => {

            new PanelProfile( document.querySelector('.panel-profile-info') );
        })
    </script>
</div>


@include('ativos/history')

@endsection