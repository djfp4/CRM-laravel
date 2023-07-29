@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Lecciones del curso: {{$curso->name}}</h3>
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
                                    @foreach($leccion as $leccions)
                                    <tr>
                                        <td>{{$leccions->name}}</td>
                                        <td>{{$leccions->description}}</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('leccion.edit', $leccions->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('leccion.destroy', $leccions->id)}}">Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $leccion->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

