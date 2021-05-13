<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            <h5>EMPRESAS</h5>
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="col-md-6">
                        <!--
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">USUARIO</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="USUARIO"  value="@if (isset($modules->USUARIO)){{$modules->USUARIO}}@endif" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">F_ACTUAL</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="date" name="F_ACTUAL"  value="@if (isset($modules->F_ACTUAL)){{$modules->F_ACTUAL}}@endif" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">PROGRAMA</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="PROGRAMA"  value="@if (isset($modules->PROGRAMA)){{$modules->PROGRAMA}}@endif" class="form-control" required>
                            </div>
                        </div>
                        !-->

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">DESCRIPCION</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea name="DESCRIPCION" class="form-control" required>@if (isset($modules->DESCRIPCION)){{$modules->DESCRIPCION}}@endif</textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">NIT</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="NIT"  value="@if (isset($modules->NIT)){{$modules->NIT}}@endif" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">F_VALIDEZ</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="date" name="F_VALIDEZ"  value="@if (isset($modules->F_VALIDEZ)){{$modules->F_VALIDEZ}}@endif" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label class="col-form-label">COD_EMP_REL</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="COD_EMP_REL"  value="@if (isset($modules->COD_EMP_REL)){{$modules->COD_EMP_REL}}@endif" class="form-control" required>
                            </div>
                        </div>


                    </div>


                    <div class="col-md-12">
                        <a href="/empresas" class="btn btn-sm btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>


                </div>
        </div>
    </div>
</div>
