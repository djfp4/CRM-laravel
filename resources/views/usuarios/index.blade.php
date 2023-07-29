@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <a class="btn btn-warning" href="{{route('usuarios.create')}}">Nuevo</a>
                                </div>
                                <form method="GET" action="{{ route('usuarios.index') }}">
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
                                    <th style="color:#fff;">Celular</th>
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @if(count($usuarios)<=0)
                                    <tr>
                                        <td colspan="5">No hay resultados</td>
                                    </tr>
                                    @else
                                    @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{$usuario->name}} {{$usuario->last_name}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>{{$usuario->phone}}
                                        <td>
                                            @if(!empty($usuario->getRoleNames()))
                                                @foreach($usuario->getRoleNames() as $roleName)
                                                <h5><span class="badge badge-dark">{{$roleName}}</span></h5>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('usuarios.edit', $usuario->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('usuarios.show', $usuario->id)}}">Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $usuarios->links() !!}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

