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
                                    <a class="btn btn-warning" href="{{route('nota.create')}}">Nueva nota</a>
                                    <a class="btn btn-warning" href="{{route('asistencia.create')}}">Nueva asistencia</a>
                                </div>
                                
                            </div>
                            <table class="table table-sm table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">E-mail</th>
                                    <th style="color:#fff;">Telefono</th>
                                    <th style="color:#fff;">Cumpleaños</th>
                                </thead>
                                <tbody>
                                    @foreach($cliente as $usuario)
                                    <tr>
                                        <td>{{ucfirst($usuario->name)}} {{ucfirst($usuario->last_name)}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>{{$usuario->phone}}</td>
                                        <td>{{$usuario->birthday}}</td>
                                    </tr>
                                    @endforeach
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

