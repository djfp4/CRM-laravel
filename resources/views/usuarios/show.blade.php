@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Eliminar usuario</h3>
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
                            {!! Form::open(array('route'=>['usuarios.destroy', $usuario->id], 'method'=>'DELETE')) !!}
                            <div class="row">
                                <h4>Desea eliminar al usuario: {{$usuario->name}} {{$usuario->last_name}}</h4>
								<br>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-success">Eliminar</button>
									<a href="/usuarios" class="btn btn-danger">Volver</a>
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

