<div class='panel-side form panel-profile-add'>

    <div class='panel-header'>
        <h4>{!!__("menu.profile")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='form-group col-md-12'>
            <label>{!! __('profile.name') !!}</label>
            <input type="text" class="form-control" name='name' placeholder='{!!__("profile.namePlaceHolder")!!}' required />
        </div>
                
        <div class='form-group col-md-12'>
            <label>{!! __('profile.nif') !!}</label>
            <input type="text" class="form-control" name='nif' placeholder='000 000 000' required />~
        </div>
                        
        <div class='form-group col-md-12'>
            <label>{!! __('profile.address') !!}</label>
            <input type="text" class="form-control" name='address' placeholder='{!!__("profile.addressPlaceHolder")!!}' required />
        </div>
             
                
        <div class='form-group col-md-12'>
            <label>{!! __('profile.zipcode') !!}</label>
            <input type="text" class="form-control" name='zipcode' placeholder='0000-000' required />
        </div>
   
        <div class='form-group col-md-12'>
            <label>{!! __('profile.locality') !!}</label>
            <input type="text" class="form-control" name='locality' placeholder='{!!__("profile.localityPlaceHolder")!!}' required />
        </div>
                
        <div class='form-group col-md-12'>
            <label>{!! __('profile.contact') !!}</label>
            <input type="text" class="form-control" name='contact' placeholder='+999 999 999 999' required />
        </div>
                
        <div class='form-group col-md-12'>
            <label>{!! __('profile.email') !!}</label>
            <input type="text" class="form-control" name='email' placeholder='suport@securenet.pt' required />
        </div>
    </div>

    <div class='footer'>
        <button class='btn btn-primary' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' action='cancel'>{{ __("form.cancel") }}</button>
    </div>

    <div class='load' rule='load'><i class="fa-duotone fa-solid fa-spinner-third"></i></div>
    <input type='hidden' name='load' value='0'/>

    <script>
        window.addEventListener('load', () => {
            window.pUserAdd = new PanelClientAdd( document.querySelector('.panel-client-addprofile') );
        })
    </script>