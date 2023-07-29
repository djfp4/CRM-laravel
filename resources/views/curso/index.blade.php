@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Cursos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-warning" href="{{route('curso.create')}}">Nuevo curso</a>
                            <a class="btn btn-warning" href="{{route('modulo.create')}}">Nuevo modulo</a>
                            <a class="btn btn-warning" href="{{route('leccion.create')}}">Nueva lección</a>
                            <a class="btn btn-warning" href="{{route('horario.create')}}">Nueva horario</a>
                            <a class="btn btn-info" href="{{route('pago.index')}}">Pagos</a>
                            <table class="table table-sm table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Descripción</th>
                                    <th style="color:#fff;">Duración</th>  
                                    <th style="color:#fff;">Docente</th>  
                                    <th style="color:#fff;">Precio</th>  
                                    
                                    <th style="color:#fff;">Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach($curso as $cursos)
                                    <tr>
                                        <td>{{$cursos->name}}</td>
                                        <td>{{$cursos->description}}</td>
                                        <td>{{$cursos->duration}} meses</td>
                                        <td>{{$cursos->primer}} {{$cursos->last_name}}</td>
                                        <td>{{$cursos->price}} bs.</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('curso.edit', $cursos->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('curso.destroy', $cursos->id)}}">Eliminar</a>
                                            <a class="btn btn-success"href="{{route('grupo.show', $cursos->id)}}">Grupos</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $curso->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

