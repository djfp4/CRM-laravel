@extends('layouts.app')

@section('content')


    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Añadir alumno</h3>
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
                            {!! Form::open(array('route'=>'alumno.store', 'method'=>'POST')) !!}
                            <div class="row">
                                
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Alumno:</label>
                                        <select name="client_id" class="form-control">
                                            @foreach($cliente as $clientes)
                                            <option value="{{$clientes->id}}">{{$clientes->name}} {{$clientes->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Grupo:</label>
                                        <select name="group_id" class="form-control">
                                            @foreach($grupo as $grupos)
                                            <option value="{{$grupos->id}}">{{$grupos->name}} {{$grupos->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                             
                                                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="reset" class="btn btn-danger">Volver</button>
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

