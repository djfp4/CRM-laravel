@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ventas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-warning" href="{{route('ventas.create')}}">Nuevo</a>
                            <a class="btn btn-warning" href="{{route('cliente.create')}}">Nuevo cliente</a>
                            <a class="btn btn-warning" href="{{route('seguimiento.create')}}">Nuevo seguimiento</a>
                            <table class="table table-sm table-striped mt-2">
                                <thead style="background-color: #042da2;">
                                    <th style="color:#fff;">Cliente</th> 
                                    <th style="color:#fff;">Manzana</th>
                                    <th style="color:#fff;">Lote</th>
                                    <th style="color:#fff;">Superficie</th>
                                    <th style="color:#fff;">Precio</th> 
                                    <th style="color:#fff;">Precio de venta</th>  
                                    <th style="color:#fff;">Modelo</th>   
                                    <th style="color:#fff;">Ubicación</th>   
                                    <th style="color:#fff;">Opciones</th>
                                </thead>
                                <tbody>
                                    @foreach($venta as $ventas)
                                    <tr>
                                        <td>{{$ventas->name}} {{$ventas->last_name}}</td>
                                        <td>{{$ventas->block}}</td>
                                        <td>{{$ventas->lot}}</td>
                                        <td>{{$ventas->surface}}</td>                                        
                                        <td>{{$ventas->price}}</td> 
                                        <td>{{$ventas->prices}}</td>                                       
                                        <td>{{$ventas->model}}</td>                                        
                                        <td>{{$ventas->city}}</td>
                                        <td>
                                            <a class="btn btn-info"href="{{route('ventas.edit', $ventas->id)}}">Editar</a>
                                            <a class="btn btn-danger"href="{{route('ventas.destroy', $ventas->id)}}">Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $venta->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

