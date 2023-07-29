@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Seguimiento</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-warning" href="{{route('seguimiento.create')}}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Celular</th>
                                    <th style="color:#fff;">Carnet</th>
                                    <th style="color:#fff;">Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach($seguir as $seguirs)
                                    <tr>
                                        <td>{{$seguirs->name}} {{$seguirs->last_name}}</td>
                                        <td>{{$seguirs->phone}}</td>
                                        <td>{{$seguirs->ci}}</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('seguimiento.show', $seguirs->client_id)}}">Detalles</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $seguir->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

