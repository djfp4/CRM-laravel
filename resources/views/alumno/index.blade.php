@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alumnos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a class="btn btn-warning" href="{{route('cliente.create')}}">Nuevo cliente</a>
                                </div>
                                
                            </div>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">E-mail</th>
                                    <th style="color:#fff;">Telefono</th>
                                    <th style="color:#fff;">Cumpleaños</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach($cliente as $usuario)
                                    <tr>
                                        <td>{{ucfirst($usuario->name)}} {{ucfirst($usuario->last_name)}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>{{$usuario->phone}}</td>
                                        <td>{{$usuario->birthday}}</td>
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

