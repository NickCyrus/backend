<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            <h5><i class="{{$infoApp->iconapp}}"></i> {{$infoApp->nameapp}}</h3></h5>
        </div>
        <div class="card-body">

            <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Nombre del modulo</label>
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <input type="hidden" name="iconapp" id="iconapp" value="@if (isset($modules->iconapp)) {{$modules->iconapp}} @else feather icon-home  @endif"  />
                                    <input type="hidden" name="urlapp"  value="@if (isset($modules->urlapp)) {{$modules->urlapp}} @endif" />
                                    <input type="hidden" name="orderapp" value="@if (isset($modules->orderapp)) {{$modules->orderapp}} @endif" />
                                    <span class="input-group-text hand" id="iconapp_Icon" onclick="openSelectIcons('iconapp')"><i class="@if (isset($modules->iconapp)) {{$modules->iconapp}} @else feather icon-home  @endif"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nameapp" name="nameapp" value="{{isset($modules->nameapp) ? $modules->nameapp : ''}}"  placeholder="Nombre del modulo" autofocus required>
                            </div>
                            <br />

                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Url modulo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text hand"><i class="simple-line sline-icon-link"></i></span>
                                </div>
                                <input type="text" class="form-control" id="urlapp" name="urlapp" value="{{isset($modules->urlapp) ? $modules->urlapp : ''}}"  placeholder="URL modulo" required>
                            </div>
                            <br />

                    </div>
                    <div class="col-md-12">
                        <a href="/{{$infoApp->urlapp}}" class="btn btn-sm btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>


                </div>
        </div>
    </div>
</div>
