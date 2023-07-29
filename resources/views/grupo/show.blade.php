@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Grupos del curso: {{$curso->name}}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a class="btn btn-warning" href="{{route('grupo.create')}}">Nuevo grupo</a>
                                    <a class="btn btn-warning" href="{{route('alumno.create')}}">Nuevo alumno</a>
                                </div>
                                </div>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Inicio</th>
                                    <th style="color:#fff;">Fin</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach($grupo as $grupos)
                                    <tr>
                                        <td>{{ucfirst($grupos->name)}}</td>
                                        <td>{{$grupos->start}}</td>
                                        <td>{{$grupos->end}}</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('grupo.edit', $grupos->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('grupo.show', $grupos->id)}}">Eliminar</a>
                                            <a class="btn btn-success"href="{{route('alumno.show', $grupos->id)}}">Alumnos</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $grupo->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

