<div class='panel form row panel-profile-info'>

    <div class='panel-header'>
        <h2>{!!__("profile.userInfo")!!}</h2>
    </div>

    <div class='form'>
    <div class='form-header'> 
        <button class='btn btn-primary' rule='save' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' rule='edit' action='edit'>{{ __("form.edit") }}</button>

    </div>
    </div>
        <div class='form-group col-md-8'>
            <label>{!! __('profile.name') !!}</label>
            <span rule='edit'>{{ !empty($profile['name']) ? $profile['name'] : '' }}</span>
            <input type="text" class="form-control" name='name' placeholder='{!!__("profile.namePlaceHolder")!!}' required rule='save' to='span' value="{{ !empty($profile['name']) ? $profile['name'] : '' }}"/>
        </div>

        <div class='form-group col-md-4'>
            <label>{!! __('profile.nif') !!}</label>
            <span rule='edit'>{{ !empty($profile['nif']) ? $profile['nif'] : '' }}</span>
            <input type="text" class="form-control" name='nif' placeholder='000 000 000' required rule='save' to='span' value="{{ !empty($profile['nif']) ? $profile['nif'] : '' }}"/>
        </div>

        <div class='form-group col-md-6'>
            <label>{!! __('profile.address') !!}</label>
            <span rule='edit'>{{ !empty($profile['address']) ? $profile['address'] : '' }}</span>
            <input type="text" class="form-control" name='address' placeholder='{!!__("profile.addressPlaceHolder")!!}' required rule='save' to='span' value="{{ !empty($profile['address']) ? $profile['address'] : '' }}"/>
        </div>
    
        <div class='form-group col-md-2'>
            <label>{!! __('profile.zipcode') !!}</label>
            <span rule='edit'>{{ !empty($profile['zipcode']) ? $profile['zipcode'] : '' }}</span>
            <input type="text" class="form-control" name='zipcode' placeholder='0000-000' required rule='save' to='span' value="{{ !empty($profile['zipcode']) ? $profile['zipcode'] : '' }}"/>
        </div>
        
        <div class='form-group col-md-4'>
            <label>{!! __('profile.locality') !!}</label>
            <span rule='edit'>{{ !empty($profile['locality']) ? $profile['locality'] : '' }}</span>  
            <input type="text" class="form-control" name='locality' placeholder='{!!__("profile.localityPlaceHolder")!!}' required rule='save' to='span' value="{{ !empty($profile['locality']) ? $profile['locality'] : '' }}"/>
        </div>
        
        <div class='form-group col-md-6'>
            <label>{!! __('profile.contact') !!}</label>
            <span rule='edit'>{{ !empty($profile['contact']) ? $profile['contact'] : '' }}</span> 
            <input type="text" class="form-control" name='contact' placeholder='+999 999 999 999' required rule='save' to='span' value="{{ !empty($profile['contact']) ? $profile['contact'] : '' }}"/>
        </div>
        
        <div class='form-group col-md-6'>
            <label>{!! __('profile.email') !!}</label>
            <span rule='edit'>{{ !empty($profile['email']) ? $profile['email'] : '' }}</span> 
            <input type="text" class="form-control" name='email' placeholder='suport@securenet.pt' required rule='save' to='span' value="{{ !empty($profile['email']) ? $profile['email'] : '' }}"/>
        </div>


    <input type='hidden' name='edit' value='0' />
    <script>
        window.addEventListener('load', () => {

            new PanelProfile( document.querySelector('.panel-profile-info') );
        })
    </script>
</div>