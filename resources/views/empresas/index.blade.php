@extends('layout')

@section('title','Dashboard')


@section('content')

        <div class="card">

                @include('part.card-header',["infoApp"=>$infoApp])

                <div class="card-body">
                    <form action="{{ url($infoApp->urlapp) }}/buscador" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('part.search')
                    </form>

                    <table class="table table-slim table-hover">
                            <thead>

                                    <th>#</th>
                                    <th>Razón social</th>
                                    <th>Nit</th>
                                    <th>Base de datos</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $modules as $module)
                                    <tr>
                                        <td>{{$module->id}}</td>
                                        <td>{{$module->rs}}</td>
                                        <td>{{$module->nit}}</td>
                                        <td>@if(isset($module->db))<i class="feather icon-server"></i> @endif {{$module->db}}</td>
                                        <td>{{$module->address}}</td>
                                        <td>{{$module->phone}}</td>
                                        <td>
                                            @include('part.btnsimpleactions', ["permisos"=>$permisos , "infoApp"=>$infoApp])
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                    @include('part.paginate', ["modules"=>$modules])
            </div>
        </div>

@endsection

