<div class='panel panel-asset'>

    <div class='panel-header {{ empty($asset) ? "show" : "" }}' action='changeShowHide'>
        <h2>{!!__("menu.asset")!!}</h2>
        <i class="fa-sharp-duotone fa-regular fa-chevron-down" rule='edit'></i>
    </div>

    <div class='form d-none' rule='preload'>

        <div class='row'>

            <!-- File -->
            <div class='form-group col-md-4'>
                <label>{!! __('register.image') !!}</label>
                <div WepulseUpload class='wepulseUpload'>
                    <input type="hidden" name='image' value=''/>
                    <div class='preview'></div>
                    <i class="fa-solid fa-x"></i>
                    <div class='drag'>Arraste o(s) seu(s) ficheiro(s) para aqui.</div>
                    <div class='input'>
                        <i class="fa-light fa-arrow-up-from-bracket"></i>
                        <span>{{__('form.uploadFile')}}</span>
                        <input type="file" value=''/>
                    </div>
                </div>
            </div>

            <div class='clearfix'></div>

            <!-- Name -->
            <div class='form-group col-md-6 float-left'>
                <label>{!! __('register.name') !!}</label>
                <input type="text" class="form-control" name='name' placeholder='{!!__("register.namePlaceHolder")!!}' required/>
            </div>

            <!-- Label -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.label') !!}</label>
                <input type="text" class="form-control" name='label' placeholder='{!!__("register.labelPlaceHolder")!!}'/>
            </div>

            <!-- Service -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.service') !!}</label>
                <input type="text" class="form-control" name='service' placeholder='{!!__("register.servicePlaceHolder")!!}'/>
            </div>

            <!-- Sofware -->
            <div class='form-group col-12 col-lg-6'>
                <label>{!! __('register.software') !!}</label>
                <input type="text" class="form-control" name='software' placeholder='{!!__("register.softwarePlaceHolder")!!}'/>
            </div>

            <!-- Access Public -->
            <div class='form-group col-12 col-lg-6 mb-0'>
                <label class='mb-0'>{!!__("register.registerText")!!}</label>
                <p>{!!__("register.registerText2")!!}</p>
            </div>

            <div class='form-group col-12 col-lg-6 form-radio'>
                <div class='inline'>
                    <input type='radio' name='accessPublic' value='Não' />
                    <span>Não</span>
                </div>
                <div class='inline'>
                    <input type='radio' name='accessPublic' value='Sim'/>
                    <span>Sim</span>
                </div>
            </div>

            <!-- Modal -->
            <div class='form-group col-md-5'>
                <label>{!! __('register.model') !!}</label>
                <input type="text" class="form-control" name='model' placeholder='{!!__("register.modelPlaceHolder")!!}'/>
            </div>
                
            <!-- IP -->
            <div class='form-group col-md-2'>
                <label>{!! __('register.ip') !!}</label>
                <input type="text" class="form-control" name='ip' placeholder='000.000.000.000'/>
            </div>

            <!-- FQDin -->
            <div class='form-group col-md-5'>
                <label>{!! __('register.fqdin') !!}</label>
                <input type="text" class="form-control" name='fqdin' placeholder='{!!__("register.fqdinPlaceHolder")!!}'/>
            </div>

            <!-- Producer -->
            <div class='form-group col-md-5'>
                <label>{!! __('register.producer') !!}</label>
                <input type="text" class="form-control" name='producer' placeholder='{!!__("register.producerPlaceHolder")!!}'/>
            </div>
                
            <!-- Register Date -->
            <div class='form-group col-md-3'>
                <label>{!! __('register.registerdate') !!}</label>
                <input type="date" class="form-control" name='registerdate' placeholder='DD/MM/YYYY'/>
            </div>

            <!-- Category -->
            <div class='form-group col-md-4'>
                <label>{!! __('register.category') !!}</label>
                <div WepulseDrop name='category_id' action='update' required>
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
                <input type="text" class="form-control" name='address' placeholder='{!!__("register.addressPlaceHolder")!!}'/>
            </div>
            
            <!-- City-->
            <div class='form-group col-md-4'>
                <label>{!! __('register.city') !!}</label>
                <input type="text" class="form-control" name='city' placeholder='Porto'/>
            </div>

            <!-- Criticality -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.criticality') !!}</label>
                <div WepulseDrop name='criticality' action='update' required>
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
                <div WepulseDrop name='risk' action='update' required>
                    <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value=''>Nenhum</div>
                        <div value='1'>Baixo</div>
                        <div value='2'>Moderado</div>
                        <div value='3'>Alto</div>
                    </div>
                </div>
            </div>

            <!-- Acquisition Cost -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.cost') !!}</label>
                <input type="text" class="form-control" name='acquisitionCost' placeholder='{!!__("register.costPlaceHolder")!!}'/>
            </div>

            <!-- Current Value -->
            <div class='form-group col-md-6'>
                <label>{!! __('register.value') !!}</label>
                <input type="text" class="form-control" name='currentValue' placeholder='{!!__("register.valuePlaceHolder")!!}'/>
            </div>
            
            <!-- Description -->
            <div class='form-group col-md-12'>
                <label>{!! __('register.description') !!}</label>
                <textarea class="form-control" name='description'></textarea>
            </div>

            <!-- Responsable -->
            <div class='form-group col-md-12'>
                <label>{!! __('register.responsable') !!}</label>
                <div WepulseDrop name='responsable_id' action='update' required>
                <div>
                        <span></span>
                        <i class="fa-solid fa-caret-down"></i>
                    </div>
                    <div>
                        <div value=''>Nenhuma</div>
                        @foreach($responsables as $r)
                        <div value='{{$c->id}}'>{{$r->name}}</div>
                        @endforeach
                    </div>
                </div>  
            </div>

            <!-- Extra field -->
            @foreach( $fields as $f )
                @if( $f->type == 'dropdown' )
                <!-- Dropdown -->
                <div class='form-group col-md-6'>
                    <label>{{ $f->name }}</label>
                    <div WepulseDrop name='field_{{ $f->id }}' action='update' {!! $f->required ? 'required':'' !!}>
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
                        @foreach( $f->data as $d )
                        <div class='inline'>
                            <input type='{{ $f->type == "checkbox" ? "checkbox" : "radio" }}' name='field_{{ $f->id }}' value='{{$d}}' {!! $f->required ? 'required':'' !!}/>
                            <span>{{$d}}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @elseif( $f->type == 'textarea' )
                <!-- Textarea -->
                <div class='form-group col-md-6'>
                    <label>{{ $f->name }}</label>
                    <textarea class="form-control" name='field_{{ $f->id }}' {!! $f->required ? 'required':'' !!}></textarea>
                </div>    
                @elseif( $f->type == 'input' )
                <!-- Input -->
                <div class='form-group col-md-6'>
                    <label>{{ $f->name }}</label>
                    <input type="text" class="form-control" name='field_{{ $f->id }}' placeholder='{{ $f->description }}' {!! $f->required ? 'required':'' !!}/>
                </div> 
                @elseif( $f->type == 'file' )
                <!-- File -->
                <div class='form-group col-md-6'>
                    <label>{{ $f->name }}</label>
                    <div WepulseUpload class='wepulseUpload'>
                        <input type="hidden" name='field_{{ $f->id }}' value=''/>
                        <div class='preview'></div>
                        <i class="fa-solid fa-x"></i>
                        <div class='drag'>Arraste o(s) seu(s) ficheiro(s) para aqui.</div>
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
            <button class='btn btn-primary' action='save'>{{ __("form.save") }}</button>
        </div>

        <input type='hidden' name='load' value='1'/>
        <input type='hidden' name='id' value=''/>
        <input type='hidden' name='mode' value='2'/>
    </div>

    <div class='load d-none' rule='load'><i class="fa-duotone fa-solid fa-spinner-third"></i></div>

    <script>
        window.addEventListener('load', () => {
            window.pAsset = new PanelAsset( document.querySelector('.panel-asset'), {!! json_encode($asset) !!} );
        })
    </script>
</div>