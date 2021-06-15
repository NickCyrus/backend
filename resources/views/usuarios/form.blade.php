<?php

    use App\Http\Controllers\ToolsController;


?>
<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            <h5><i class="{{$infoApp->iconapp}}"></i> {{$infoApp->nameapp}}</h3></h5>
        </div>
        <div class="card-body">

            <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name',$modules->name)}}"  placeholder="Nombre" autofocus required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email',$modules->email)}}"  placeholder="Email" required>
                         @error('email')
                                  <div class="p-1 error-field">{{$message}}</div>
                         @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Perfil</label>
                        {{Tools::selectHTML(["model"=>'profile',
                                "key"=>'id',
                                "label"=>"profname",
                                "required"=>true,
                                "selected"=>old('profid',$modules->profid),
                                "name"=>"profid"
                           ])}}
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Empresa</label>
                            {{Tools::selectHTML(["model"=>'enterprise',
                                "key"=>'ID_EMP',
                                "label"=>"DESCRIPCION",
                                "class"=>'select2',
                                "multiple"=>true,
                                "selected"=>old('empresas',$empresas),
                                "name"=>"empresas[]"
                           ])}}
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" value=""  {{isset($isnew) ? 'required' : ''}}   placeholder="Contraseña">
                        @error('password')
                            <div class="p-1 error-field">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Confirmar contraseña</label>
                        <input type="password" class="form-control" id="password2" name="password2" value="" {{isset($isnew) ? 'required' : ''}}  placeholder="Confirmar contraseña">
                    </div>

                    <div class="col-md-12  mb-3">
                        <a href="/{{$infoApp->urlapp}}" class="btn btn-sm btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>

                </div>
        </div>
    </div>
</div>

@section('addFooter')
    <script>

        $(function(){

                $('#f{{$infoApp->urlapp}}').submit(function(e){

                    var self =  $(this);
                    var input = '#email';

                    e.preventDefault();

                    @if (isset($isnew))
                        if (!$('#password').val()  ){
                            fn.alert("Por favor indique una contraseña");
                            return false;
                        }
                    @endif

                    if ($('#password').val()){
                        if ($('#password').val() != $('#password2').val() ){
                            fn.alert("Las contraseñas no coinciden");
                            return false;
                        }
                    }

                    fn.ajax({
                            beforeSend : function(){
                                fn.wait('Por favor espere');
                            },
                            @if(isset($modules->id))
                                url : '{{URL::to($infoApp->urlapp)}}/exist/'+$(input).val()+'/{{$modules->id}}',
                             @else
                                url : '{{URL::to($infoApp->urlapp)}}/exist/'+$(input).val(),
                            @endif
                            success : function(resp){
                                if (resp.rs === 1){
                                    fn.closeModal()
                                    fn.alert("Lo sentimos el email <b>"+$(input).val()+"</b> ya está en uso.");
                                }else{
                                    fn.closeModal()
                                    self.unbind()
                                    self.submit();
                                }
                            }
                    })

                })
        })

    </script>
@endsection

