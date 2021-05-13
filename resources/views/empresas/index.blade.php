@extends('layout')

@section('title','Dashboard')


@section('content')

        <div class="card">

                <div class="card-header">
                    <h5><i class="{{$infoApp->iconapp}}"></i> {{$infoApp->nameapp}}</h3></h5>
                    @if ($permisos->anew && $empresaSelect == 0)
                    <div class="pull-right">
                            <a class="btn btn-sm btn-primary" href="{{ url($infoApp->urlapp.'/create' ) }}">Nuevo</a>
                    </div>
                @endif
                </div>
                <div class="card-body">
                <table class="table table-slim table-hover">
                        <thead>

                                <th>#</th>
                                <th>DESCRIPCION</th>
                                <th>NIT</th>
                                <th>F_VALIDEZ</th>
                                <th>COD_EMP_REL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $modules as $module)
                                <tr>
                                    <td>{{$module->ID_EMP}}</td>
                                    <td>{{($module->DESCRIPCION)}}</td>
                                    <td>{{($module->NIT)}}</td>
                                    <td>{{(_fechaInput($module->F_VALIDEZ))}}</td>
                                    <td>{{($module->COD_EMP_REL)}}</td>

                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                @if ($permisos->aedit)
                                                <a class="btn btn-sm btn-primary m-0" href="{{ url($infoApp->urlapp.'/'.$module->ID_EMP.'/edit' ) }}">Editar</a>
                                                @endif
                                                @if ($permisos->adelete)
                                            <form action="{{ url($infoApp->urlapp.'/'.$module->ID_EMP ) }}" method="post" class="d-inline">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-sm btn-danger m-0 confirmacion" data-title="Desea borrar esta empresa ?">Borrar</button>
                                            </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>

@endsection

