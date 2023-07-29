@extends('layouts.app')

@section('content')


    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Añadir pago</h3>
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
                            {!! Form::open(array('route'=>'pago.store', 'method'=>'POST')) !!}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Cliente:</label>
                                        <select name="client_id" class="form-control">
                                            @foreach($cliente as $clientes)
                                            <option value="{{$clientes->id}}">{{$clientes->name}} {{$clientes->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Tipo de pago:</label>
                                        <select name="type" class="form-control">
                                            <option>Efectivo</option>
                                            <option>Transferencia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Curso:</label>
                                        <select name="course_id" class="form-control">
                                            @foreach($curso as $cursos)
                                            <option value="{{$cursos->id}}">{{$cursos->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Grupo:</label>
                                        <select name="group_id" class="form-control">
                                            @foreach($grupo as $grupos)
                                            <option value="{{$grupos->id}}">{{$grupos->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Monto de pago (boliivianos):</label>
                                        {!! Form::number('mont', null, array('class' => 'form-control', 'required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Fecha de pago:</label>
                                        {!! Form::date('date', null, array('class' => 'form-control', 'required')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Agente:</label>
                                        <select name="user_id" class="form-control">
                                            @foreach($user as $users)
                                            <option value="{{$users->id}}">{{$users->name}} {{$users->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="/pago" class="btn btn-danger">Volver</a>
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

