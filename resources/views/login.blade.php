@extends('page')
@section('content')

    <div class='panel-login'>
        <div class='image'>
            <div>
                <img src='images/logo.png' class='mb-5'/>
                <img src='images/secure.png'/>
            </div>
        </div>
        <div class='login'>

            <div class='form'>
                <h1 class='mb-5'>{{__('form.welcome')}}</h1>

                <div class='form-group col-md-12'>
                    <input type="text" class="form-control" name='email' placeholder='Email' required/>
                </div>
                <div class='form-group col-md-12'>
                    <input type="password" class="form-control" name='password' placeholder='Password' required/>
                </div>

                <button class='btn btn-primary col-md-6' action='login'>{{__('form.enter')}}</button>
            </div>
        </div>
        <script>
            window.addEventListener('load', () => {
                window.pUsers = new PanelLogin( document.querySelector('.panel-login') );
            })
        </script>
    </div>
   
@endsection