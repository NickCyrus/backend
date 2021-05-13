@extends('layout')

@section('title',$infoApp->nameapp)


@section('content')

        <div class="card">
                <div class="card-header">
                    <h5><i class="{{$infoApp->iconapp}}"></i> {{$infoApp->nameapp}}</h3></h5>
                    @if ($permisos->anew)
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
                                <th>Modulo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $modules as $module)
                                <tr>
                                    <td>{{$module->id}}</td>
                                    <td><i class="@if ($module->iconapp) {{$module->iconapp}} @endif"></i> {{$module->nameapp}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                            @if ($permisos->aedit)
                                                <a class="btn btn-sm btn-primary m-0" href="{{ url('modules/'.$module->id.'/edit' ) }}">Editar</a>
                                            @endif
                                            @if ($permisos->adelete)
                                                <form action="{{ url('modules/'.$module->id ) }}" method="post" class="d-inline">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button class="btn btn-sm btn-danger m-0 confirmacion" data-title="Desea borrar este modulo ?">Borrar</button>
                                                </form>
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

