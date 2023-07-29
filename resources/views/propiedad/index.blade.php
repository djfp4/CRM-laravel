@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Propiedades</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-warning" href="{{route('propiedad.create')}}">Nuevo</a>
                            <a class="btn btn-warning" href="{{route('models.create')}}">Nuevo modelo</a>
                            <a class="btn btn-warning" href="{{route('locations.create')}}">Nueva ubicación</a>
                            <table class="table table-striped table-sm mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Manzana</th>
                                    <th style="color:#fff;">Lote</th>
                                    <th style="color:#fff;">Superficie</th>
                                    <th style="color:#fff;">Precio</th>    
                                    <th style="color:#fff;">Modelo</th>   
                                    <th style="color:#fff;">Ubicación</th>    
                                    <th style="color:#fff;">Estado</th>    
                                    <th style="color:#fff;">Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach($propiedad as $propiedads)
                                    <tr>
                                        <td>{{$propiedads->block}}</td>
                                        <td>{{$propiedads->lot}}</td>
                                        <td>{{$propiedads->surface}}</td>                                        
                                        <td>{{$propiedads->price}}</td>                                        
                                        <td>{{$propiedads->model}}</td>                                        
                                        <td>{{$propiedads->city}}</td>
                                        @if($propiedads->state == 1)
                                                                                    
                                        <td><span class="badge badge-success">Disponible</span</td>
                                        @endif
                                        @if($propiedads->state == 0)
                                                                                    
                                        <td><span class="badge badge-danger">Vendido</span></td>
                                        @endif
                                        <td>
                                            <a class="btn btn-info"href="{{route('propiedad.edit', $propiedads->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('propiedad.show', $propiedads->id)}}">Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $propiedad->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

