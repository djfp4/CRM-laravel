@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Detalles del pago:</h3>
        </div>
        <div>
            <h5 class="page__heading">Cliente: {{$cliente->name}} {{$cliente->last_name}} | Curso: {{$cliente->curso}} | Deuda: {{$falta}} bs.</h5>
            <hr>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-warning" href="{{route('pago.create')}}">Añadir pago</a>
                            <a class="btn btn-danger" href="{{route('pago.index')}}">Volver</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Monto</th>
                                    <th style="color:#fff;">Fecha</th>
                                    <th style="color:#fff;">Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach($pago_detalle as $pago_detalles)
                                    <tr>
                                        <td>{{$pago_detalles->mont}} Bs.</td>
                                        <td>{{$pago_detalles->date}}</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('pago_detalle.edit', $pago_detalles->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('pago_detalle.destroy', $pago_detalles->id)}}">Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $pago_detalle->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

