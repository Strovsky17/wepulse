@extends('page')
@extends('misc.sidebar', [ "page" => "profile", "subpage" => "" ])
@extends('misc.topbar')

@section('content')

    <div class='panel form row'>
    
        <div class='form-group col-md-8'>
            <label>{!! __('profile.name') !!}</label>
            <input type="text" class="form-control" name='name' placeholder='{!!__("profile.namePlaceHolder")!!}' required>
        </div>

        <div class='form-group col-md-4'>
            <label>{!! __('profile.nif') !!}</label>
            <input type="text" class="form-control" name='nif' placeholder='000000000' required>
        </div>

        <div class='form-group col-md-6'>
            <label>{!! __('profile.address') !!}</label>
            <input type="text" class="form-control" name='address' placeholder='{!!__("profile.addressPlaceHolder")!!}' required>
        </div>
      
        <div class='form-group col-md-2'>
            <label>{!! __('profile.zipcode') !!}</label>
            <input type="text" class="form-control" name='zipcode' placeholder='0000-000' required>
        </div>
        
        <div class='form-group col-md-4'>
            <label>{!! __('profile.locality') !!}</label>
            <input type="text" class="form-control" name='locality' placeholder='{!!__("profile.localityPlaceHolder")!!}' required>
        </div>
        
        <div class='form-group col-md-6'>
            <label>{!! __('profile.contact') !!}</label>
            <input type="text" class="form-control" name='locality' placeholder='990000000' required>
        </div>
        
        <div class='form-group col-md-6'>
            <label>{!! __('profile.email') !!}</label>
            <input type="text" class="form-control" name='locality' placeholder='suport@securenet.pt' required>
        </div>

    </div>

@endsection