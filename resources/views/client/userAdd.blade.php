<div class='panel-side form panel-user-add'>

    <div class='panel-header'>
        <h4>{!!__("profile.user")!!}</h4>
    </div>

    <div class='form'>
        
        <div class='form-group col-md-12'>
            <label>{!! __('profile.name') !!}</label>
            <input type="text" class="form-control" name='name' placeholder='{!!__("profile.namePlaceHolder")!!}' required />
        </div>
                
        <div class='form-group col-md-12'>
            <label>{!! __('profile.phone') !!}</label>
            <input type="text" class="form-control" name='phone' placeholder='351000000000' required />
        </div>
                        
        <div class='form-group col-md-12'>
            <label>{!! __('profile.email') !!}</label>
            <input type="text" class="form-control" name='email' placeholder='Email' required />
        </div>
        
        <div class='form-group col-md-12'>
            <label>Password</label>
            <input type="password" class="form-control" name='password' placeholder='Password' required />
        </div>
             
        <div class='form-group col-md-12'>
            <label>{!! __('profile.role') !!}</label>
            <div WepulseDrop name='role'>

                <div>
                    <span></span>
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <div>
                    <div value='{!!__("profile.roleAdmin")!!}'>{!! __('profile.roleAdmin') !!}</div>
                    <div value='{!!__("profile.roleWorker")!!}'>{!! __('profile.roleWorker') !!}</div>
                </div>
            </div>
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
            window.pUserAdd = new PanelUserAdd( document.querySelector('.panel-user-add') );
        })
    </script>