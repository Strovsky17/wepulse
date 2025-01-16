<div class='panel panel-asset'>

    <div class='panel-header'>
        <h2>{!!__("menu.register")!!}</h2>

        <button class='btn btn-primary' rule='edit' action='save'>{{ __("form.save") }}</button>
        <button class='btn btn-secondary' rule='view' action='edit'>{{ __("form.edit") }}</button>
    </div>

    <div class='form d-none' rule='preload'>

        <div class='row'>

            <!-- Name -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.name') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='name' placeholder='{!!__("register.namePlaceHolder")!!}' rule='edit' to='span' required/>
            </div>

            <!-- Label -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.label') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='label' placeholder='{!!__("register.labelPlaceHolder")!!}' rule='edit' to='span'/>
            </div>

            <!-- Service -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.service') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='service' placeholder='{!!__("register.servicePlaceHolder")!!}' rule='edit' to='span'/>
            </div>

            <!-- Sofware -->
            <div class='form-group col-12 col-lg-6'>
                <label>{!! __('register.software') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='software' placeholder='{!!__("register.softwarePlaceHolder")!!}' rule='edit' to='span'/>
            </div>

            <!-- Access Public -->
            <div class='form-group col-12 col-lg-6 mb-0'>
                <label class='mb-0'>{!!__("register.registerText")!!}</label>
                <p>{!!__("register.registerText2")!!}</p>
            </div>

            <div class='form-group col-12 col-lg-6 form-radio'>
                <span rule='view'></span>
                <div class='inline' rule='edit'>
                    <input type='radio' name='accessPublic' value='Não' to='span' />
                    <span>Não</span>
                </div>
                <div class='inline' rule='edit'>
                    <input type='radio' name='accessPublic' value='Sim' to='span'/>
                    <span>Sim</span>
                </div>
            </div>

            <!-- Modal -->
            <div class='form-group col-md-5'>
                <label>{!! __('register.model') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='model' placeholder='{!!__("register.modelPlaceHolder")!!}' rule='edit' to='span'/>
            </div>
                
            <!-- IP -->
            <div class='form-group col-md-2'>
                <label>{!! __('register.ip') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='ip' placeholder='000.000.000.000' rule='edit' to='span'/>
            </div>

            <!-- FQDin -->
            <div class='form-group col-md-5'>
                <label>{!! __('register.fqdin') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='fqdin' placeholder='{!!__("register.fqdinPlaceHolder")!!}' rule='edit' to='span'/>
            </div>

            <!-- Producer -->
            <div class='form-group col-md-5'>
                <label>{!! __('register.producer') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='producer' placeholder='{!!__("register.producerPlaceHolder")!!}' rule='edit' to='span'/>
            </div>
                
            <!-- Register Date -->
            <div class='form-group col-md-3'>
                <label>{!! __('register.registerdate') !!}</label>
                <span rule='view'></span>
                <input type="date" class="form-control" name='registerdate' placeholder='DD/MM/YYYY' rule='edit' to='span'/>
            </div>

            <!-- Category -->
            <div class='form-group col-md-4'>
                <label>{!! __('register.category') !!}</label>
                <span rule='view'></span>
                <div WepulseDrop name='category_id' action='update' required to='span' rule='edit'>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value=''>Nenhuma</div>
                        @foreach($categories as $c)
                        <div value='{{$c->id}}'>{{$c->name}}</div>
                        @endforeach
                    </div>
                </div>                
            </div>

            <!-- Address -->
            <div class='form-group col-md-8'>
                <label>{!! __('register.address') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='address' placeholder='{!!__("register.addressPlaceHolder")!!}' rule='edit' to='span'/>
            </div>
            
            <!-- City-->
            <div class='form-group col-md-4'>
                <label>{!! __('register.city') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='city' placeholder='Porto' rule='edit' to='span'/>
            </div>

            <!-- Criticality -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.criticality') !!}</label>
                <span rule='view'></span>
                <div WepulseDrop name='criticality' action='update' required to='span' rule='edit'>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value=''>Nenhuma</div>
                        <div value='1'>Pouca</div>
                        <div value='2'>Media</div>
                        <div value='3'>Alta</div>
                    </div>
                </div>
            </div>
            
            <!-- Risk -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.risk') !!}</label>
                <span rule='view'></span>
                <div WepulseDrop name='risk' action='update' required to='span' rule='edit'>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value=''>Nenhum</div>
                        <div value='1'>Baixo</div>
                        <div value='2'>Moderado</div>
                        <div value='3'>Alta</div>
                    </div>
                </div>
            </div>

            <!-- Acquisition Cost -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.cost') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='acquisitionCost' placeholder='{!!__("register.costPlaceHolder")!!}' rule='edit' to='span'/>
            </div>

            <!-- Current Value -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.value') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='currentValue' placeholder='{!!__("register.valuePlaceHolder")!!}' rule='edit' to='span'/>
            </div>
            
            <!-- Description -->
            <div class='form-group col-md-12'>
                <label>{!! __('register.description') !!}</label>
                <span rule='view'></span>
                <textarea class="form-control" name='description' rule='edit' to='span'></textarea>
            </div>

            <!-- Responsable -->
            <div class='form-group col-md-12'>
                <label>{!! __('register.responsable') !!}</label>
                <span rule='view'></span>
                <input type="text" class="form-control" name='responsable' placeholder='{!!__("register.responsablePlaceHolder")!!}' rule='edit' to='span'/>
            </div>

            <!-- Extra field -->
            @foreach( $fields as $f )
                @if( $f->type == 'dropdown' )
                <!-- Dropdown -->
                <div class='form-group col-md-6'>
                    <label>{{ $f->name }}</label>
                    <span rule='view'></span>
                    <div WepulseDrop name='field_{{ $f->id }}' action='update' to='span' rule='edit' {!! $f->required ? 'required':'' !!}>
                        <div>
                            <span></span>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                        <div>
                            <div value=''></div>
                            @foreach( $f->data as $d )
                                <div value='{{$d}}'>{{$d}}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @elseif( $f->type == 'checkbox' || $f->type == 'radiobutton' )
                <!-- Checkbox && Radio -->          
                <div class='form-group col-md-6 form-radio'>
                    <label>{{ $f->name }}</label>
                    <div>
                        <span rule='view'></span>
                        @foreach( $f->data as $d )
                        <div class='inline' rule='edit'>
                            <input type='{{ $f->type == "checkbox" ? "checkbox" : "radio" }}' name='field_{{ $f->id }}' value='{{$d}}' to='span' {!! $f->required ? 'required':'' !!}/>
                            <span>{{$d}}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @elseif( $f->type == 'textarea' )
                <!-- Textarea -->
                <div class='form-group col-md-6'>
                    <label>{{ $f->name }}</label>
                    <span rule='view'></span>
                    <textarea class="form-control" name='field_{{ $f->id }}' rule='edit' to='span' {!! $f->required ? 'required':'' !!}></textarea>
                </div>    
                @elseif( $f->type == 'input' )
                <!-- Input -->
                <div class='form-group col-md-6'>
                    <label>{{ $f->name }}</label>
                    <span rule='view'></span>
                    <input type="text" class="form-control" name='field_{{ $f->id }}' placeholder='{{ $f->description }}' rule='edit' to='span' {!! $f->required ? 'required':'' !!}/>
                </div> 
                @elseif( $f->type == 'file' )
                <!-- File -->
                <div class='form-group col-md-6'>
                    <label>{{ $f->name }}</label>
                    <div WepulseUpload class='wepulseUpload'>
                        <input type="hidden" name='field_{{ $f->id }}' value=''/>
                        <div class='drag'>Arraste o(s) seu(s) ficheiro(s) para aqui.</div>
                        <div class='preview'></div>
                        <div class='input'>
                            <i class="fa-light fa-arrow-up-from-bracket"></i>
                            <span>{{__('form.uploadFile')}}</span>
                            <input type="file" value=''/>
                        </div>
                    </div>
                </div>    
                @else
                    {{ $f->type }}
                @endif
            @endforeach
        </div>

        <div class='form-footer'>
            <button class='btn btn-primary' rule='edit' action='save'>{{ __("form.save") }}</button>
            <button class='btn btn-secondary' rule='view' action='edit'>{{ __("form.edit") }}</button>
        </div>

        <input type='hidden' name='load' value='1'/>
        <input type='hidden' name='id' value=''/>
        <input type='hidden' name='mode' value='2'/>
    </div>

    <div class='load d-none' rule='load'><i class="fa-duotone fa-solid fa-spinner-third"></i></div>

    <script>
        
        window.addEventListener('load', () => {
            new PanelAsset( document.querySelector('.panel-asset'), {!! json_encode($asset) !!} );
        })
    </script>

</div>