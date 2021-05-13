@extends('layout')

@section('title',$infoApp->nameapp)


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
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Perfil</th>
                                <th>Empresa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $modules as $module)
                                <tr>
                                    <td>{{$module->id}}</td>
                                    <td>{{$module->name}}</td>
                                    <td>{{$module->email}}</td>
                                    <td>{{$module->profname}}</td>
                                    <td>{{$module->DESCRIPCION}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                            @if ($empresaSelect == 0)
                                                @if ($permisos->aedit)
                                                    <a class="btn btn-sm btn-primary m-0" href="{{ url($infoApp->urlapp.'/'.$module->id.'/edit' ) }}">Editar</a>
                                                @endif
                                                @if ($permisos->adelete)
                                                    <form action="{{ url($infoApp->urlapp.'/'.$module->id ) }}" method="post" class="d-inline">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button class="btn btn-sm btn-danger m-0 confirmacion" data-title="Desea borrar este usuario ?">Borrar</button>
                                                    </form>
                                                @endif
                                            @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
                <div class="row col-md-12">
                        <div class="m-auto">
                            {{ $modules->links() }}
                        </div>
                </div>
            </div>
        </div>

@endsection

