@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Creditos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-warning" href="{{route('credito.create')}}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Monto</th>
                                    <th style="color:#fff;">Banco</th>
                                    <th style="color:#fff;">Interes</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Cuotas</th>
                                    <th style="color:#fff;">Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach($credito as $creditos)
                                    <tr>
                                        <td>{{$creditos->amount}} $us</td>
                                        <td>{{$creditos->bank}}</td>
                                        <td>{{$creditos->interest}} %</td>
                                        <td>{{$creditos->name}} {{$creditos->last_name}}</td>
                                        <td>{{$creditos->fees}} meses</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('credito.edit', $creditos->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('credito.show', $creditos->id)}}">Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $credito->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

