@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Modulos del curso: {{$curso->name}}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-warning" href="{{route('modulo.create')}}">Nuevo modulo</a>
                            <a class="btn btn-warning" href="{{route('leccion.create')}}">Nueva lección</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Descripción</th>
                                    <th style="color:#fff;">Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach($modulo as $modulos)
                                    <tr>
                                        <td>{{$modulos->name}}</td>
                                        <td>{{$modulos->description}}</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('modulo.edit', $modulos->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('modulo.destroy', $modulos->id)}}">Eliminar</a>
                                            <a class="btn btn-success"href="{{route('leccion.show', $modulos->id)}}">Más</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $modulo->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

