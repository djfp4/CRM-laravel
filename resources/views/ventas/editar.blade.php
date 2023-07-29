@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar venta</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                <strong>!Revise los campos</strong>
                                @foreach($errors->all() as $error)
                                <span class="badge badge-danger">{{$error}}</span>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                   
                            </div>
                            @endif
                            {!! Form::model($venta, ['method'=>'PUT', 'route'=>['ventas.update',$venta->id]]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Cliente</label>
                                        <select name="client_id" class="form-control">
                                            <option value="{{$client->id}}">
                                                {{$client->name}} {{$client->last_name}}
                                            </option>
                                            @foreach($clientes as $cliente)
                                            <option value="{{$cliente->id}}">
                                                {{$cliente->name}} {{$cliente->last_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Propiedad</label>
                                        <select name="property_id" class="form-control">
                                            <option value="{{$propied->id}}">
                                                Manzana:{{$propied->block}} | Lote:{{$propied->lot}} | Superficie:{{$propied->surface}} | Precio:{{$propied->price}} | Modelo:{{$propied->model}} | Ubicacion{{$propied->city}}
                                            </option>
                                            @foreach($propiedad as $m)
                                            <option value="{{$m->id}}">
                                                Manzana:{{$m->block}} | Lote:{{$m->lot}} | Superficie:{{$m->surface}} | Precio:{{$m->price}} | Modelo:{{$m->model}} | Ubicacion{{$m->city}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Precio de venta(Dolares):</label>
                                        {!! Form::number('prices' , null ,array('class'=>'form-control','required')) !!}
                                    </div>
                                </div>                                
                                
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="/ventas" class="btn btn-danger">Volver</a>
                                </div>
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

