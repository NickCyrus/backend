<div class="row">
    <div class="card col-md-12">
        @include('part.card-header',["infoApp"=>$infoApp])
        <div class="card-body">
            <div class="row">
                    <div class="col-md-6">

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Razón social</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="rs" value="{{old('rs',$modules->rs)}}" required >
                                @error('rs')
                                  <div class="p-1 error-field">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">NIT</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="nit"  value="{{old('nit',$modules->nit)}}" class="form-control" required>
                                @error('nit')
                                    <div class="p-1 error-field">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Forma jurídica</label>
                            </div>
                            <div class="col-sm-9">
                                {{Tools::selectHTML(["model"=>'listopction',
                                                 "key"=>'id',
                                                 "label"=>"label",
                                                 "where"=>"type|1",
                                                 "selected"=>old('forjur',$modules->forjur),
                                                 "name"=>"forjur"
                                                ])}}
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Actividad</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="activity"  value="{{old('activity',$modules->activity)}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Dirección</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="address"  value="{{old('address',$modules->address)}}" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Teléfono</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="phone"  value="{{old('phone',$modules->phone)}}" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Cuidad</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="city"  value="{{old('city',$modules->city)}}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">Departamento</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="dept"  value="{{old('dept',$modules->dept)}}" class="form-control">
                            </div>
                        </div>
                    </div>


                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <label class="col-form-label bold subline">Base de datos</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="db"  value="{{old('db',$modules->db)}}" class="form-control">
                                </div>
                            </div>
                        </div>

              </div>
                    @include('part.btn-submit',["infoApp"=>$infoApp])

                </div>
        </div>
    </div>
</div>
