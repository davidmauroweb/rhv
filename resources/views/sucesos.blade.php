@extends('layouts.app')

@section('content')
<script>
    $(document).ready(function(){
      $("#0").click(function(){
        $(".td0").show();
        $(".td1").hide();
        $(".td2").hide();
      });
      $("#1").click(function(){
        $(".td0").hide();
        $(".td1").show();
        $(".td2").hide();
      });
      $("#2").click(function(){
        $(".td0").hide();
        $(".td1").hide();
        $(".td2").show();
      });
      $("#3").click(function(){
        $(".td0").show();
        $(".td1").show();
        $(".td2").show();
      });
    });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="bi bi-boxes"></i> Sucesos
                    <button id="0" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-car-front-fill"></i></button>
                    <button id="1" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-heart-pulse-fill"></i></button>
                    <button id="2" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-universal-access-circle"></i></button>
                    <button id="3" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-three-dots"></i></button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<div class="table-responsive">
                    <table class="table table-sn table-hover">
                    <thead>
                        <th>#</th>
                        <th>TIPO</th>
                        <th>NOMBRE</th>
                        <th>AVISO</th>
                        <th>DESCRIPCION</th>
                        <th><i class="bi bi-pencil-square"></i></th>
                    </thead>
                    <tbody>
                    @foreach ($suceso as $s)
                        <tr class="align-middle td{{$s->tipo}}">
                            <td>{{$s->id}}</td>
                            <td>@switch($s->tipo)
                                @case(0)
                                <i class="bi bi-car-front-fill"></i>@break
                                @case(1)
                                <i class="bi bi-heart-pulse-fill"></i>@break
                                @case(2)
                                <i class="bi bi-universal-access-circle"></i>@break
                                @endswitch</td>
                            <td>{{$s->nombresuc}}</td>
                            <td>{{$s->vigencia}} días</td>
                            <td>{{$s->desc}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#m{{$s->id}}"><i class="bi bi-pencil-square"></i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="m{{$s->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Editar {{$s->nombresuc}}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('sucesos.update', $s->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                        Nombre
                                        <input type="text" name="nombre" class="form-control form-control-sm" value="{{$s->nombresuc}}" maxlength="20">
                                        <div class="row">
                                            <div class="col">
                                                Días de aviso
                                                <input type="number" name="vigencia" class="form-control form-control-sm" value="{{$s->vigencia}}" maxlength="8">
                                            </div>
                                            <div class="col">
                                                Tipo
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tipo">
                                                <option {{ ( $s->tipo == "0") ? 'selected' : '' }} value="0">Vehículos</option>
                                                <option {{ ( $s->tipo == "1") ? 'selected' : '' }} value="1">Salud</option>
                                                <option {{ ( $s->tipo == "2") ? 'selected' : '' }} value="2">Seguridad</option>
                                                </select>
                                            </div>
                                        </div>
                                        Descripción
                                        <textarea class="form-control" id="textarea" rows="3" name="desc" maxlength="1000">{{$s->desc}}</textarea>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
</div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mm">Agregar</button>
                    <div class="modal fade" id="mm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Agregar Nuevo Suceso</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('sucesos.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                Nombre
                                <input type="text" name="nombre" class="form-control form-control-sm" value="" maxlength="20" placeholder="Nombre">
                                <div class="row">
                                    <div class="col">
                                        Días de aviso
                                        <input type="number" name="vigencia" class="form-control form-control-sm" value="" maxlength="8" placeholder="Días">
                                    </div>
                                    <div class="col">
                                        Tipo
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tipo">
                                        <option value="0">Vehículos</option>
                                        <option value="1">Salud</option>
                                        <option value="2">Seguridad</option>
                                        </select>
                                    </div>
                                </div>
                                Descripción
                                <textarea class="form-control" id="textarea" rows="3" name="desc" maxlength="1000" placeholder="Descripción opcional"></textarea>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
