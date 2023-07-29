@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar propiedad</h3>
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
                            {!! Form::model($propiedad, ['method'=>'PUT', 'route'=>['propiedad.update',$propiedad->id]]) !!}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Manzana:</label>
                                        {!! Form::text('block',null ,array('class'=>'form-control','required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Lote:</label>
                                        {!! Form::text('lot',null ,array('class'=>'form-control','required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Superficie(metros cuadrados):</label>
                                        {!! Form::number('surface', null, array('class' => 'form-control', 'required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Precio (Dolares):</label>
                                        {!! Form::number('price' , null ,array('class'=>'form-control','required')) !!}
                                    </div>
                                </div>                                
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Ubicación:</label>
                                        <select name="location_id" class="form-control">
                                            @foreach($locacion as $l)
                                            <option value="{{$l->id}}">{{$l->city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Tipo:</label>
                                        <select name="type_id" class="form-control">
                                            @foreach($modelo as $m)
                                            <option value="{{$m->id}}">{{$m->model}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
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

