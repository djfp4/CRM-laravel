@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Pagos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-warning" href="{{route('pago.create')}}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Curso</th>
                                    <th style="color:#fff;">Tipo de pago</th>  
                                    <th style="color:#fff;">Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach($pago as $pagos)
                                    <tr>
                                        <td>{{$pagos->name}} {{$pagos->last_name}}</td>
                                        <td>{{$pagos->curso}}</td>
                                        <td>{{$pagos->type}}</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('pago.edit', $pagos->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('pago.destroy', $pagos->id)}}">Eliminar</a>
                                            <a class="btn btn-success"href="{{route('pago_detalle.show', $pagos->id)}}">Más</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $pago->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

