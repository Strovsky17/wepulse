<div class='panel form row panel-profile-info'>

    <div class='panel-header'>
        <h2>{!!__("profile.userInfo")!!}</h2>

        <button class='btn btn-primary' rule='save' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' rule='edit' action='edit'>{{ __("form.edit") }}</button>
    </div>
    
    <div class='form-group col-md-8'>
        <label>{!! __('profile.name') !!}</label>
        <span rule='edit'>{!!__("profile.namePlaceHolder")!!}</span>
        <input type="text" class="form-control" name='name' placeholder='{!!__("profile.namePlaceHolder")!!}' required rule='save' to='span'/>
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
        <input type="text" class="form-control" name='contact' placeholder='990000000' required>
    </div>
    
    <div class='form-group col-md-6'>
        <label>{!! __('profile.email') !!}</label>
        <input type="text" class="form-control" name='email' placeholder='suport@securenet.pt' required>
    </div>

    <input type='hidden' name='edit' value='0' />

    <script>
        
        window.addEventListener('load', () => {

            new PanelProfile( document.querySelector('.panel-profile-info') );
        })
    </script>
</div>