@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Clientes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a class="btn btn-warning" href="{{route('cliente.create')}}">Nuevo cliente</a>
                                    <a class="btn btn-warning" href="{{route('seguimiento.create')}}">Nuevo seguimiento</a>
                                </div>
                                <form method="GET" action="{{ route('cliente.index') }}">
                                <div class="row">
                                <div class="col-xs-9 col-sm-9 col-md-9">
                                    <input type="text" name="texto" class="form-control" value="{{$texto}}" placeholder="Buscar">
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <input type="submit" value="Buscar" class="btn btn-primary">
                                </div></div>
                                </form>
                            </div>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">E-mail</th>
                                    <th style="color:#fff;">Telefono</th>
                                    <th style="color:#fff;">Cumpleaños</th>
                                    <th style="color:#fff;">Estado</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @if(count($cliente)<=0)
                                    <tr>
                                        <td colspan="5">No hay resultados</td>
                                    </tr>
                                    @else
                                    @foreach($cliente as $usuario)
                                    <tr>
                                        <td>{{ucfirst($usuario->name)}} {{ucfirst($usuario->last_name)}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>{{$usuario->phone}}</td>
                                        <td>{{$usuario->birthday}}</td>
                                        @switch($usuario->state)
                                            @case(1)
                                                <td><span class="badge badge-success">Nuevo</span></td>
                                                @break

                                            @case(2)
                                                <td><span class="badge badge-warning">Contactado</span></td>
                                                @break

                                            @case(3)
                                                <td>
                                                    <span class="badge badge-primary">
                                                        <a style="color:#FFF;" href="{{route('seguimiento.show', $usuario->id)}}">
                                                            Seguimiento
                                                        </a>
                                                    </span>
                                                </td>
                                                @break
                                                
                                            @case(4)
                                                <td><span class="badge badge-danger">Cerrado</span></td>
                                                @break

                                            @default
                                                <td>El valor no coincide con ningún caso</td>
                                        @endswitch
                                        <td>
                                            <a class="btn btn-info"href="{{route('cliente.edit', $usuario->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('cliente.show', $usuario->id)}}">Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $cliente->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

