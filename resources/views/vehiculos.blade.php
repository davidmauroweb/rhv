@extends('layouts.app')

@section('content')
<script>
    $(document).ready(function(){
      $("#Automovil").click(function(){
        $(".tdAutomovil").show();
        $(".tdFurgón").hide();
        $(".tdPick-Up").hide();
        $(".tdCamión").hide();
        $(".tdOtro").hide();
      });
      $("#Furgón").click(function(){
        $(".tdAutomovil").hide();
        $(".tdFurgón").show();
        $(".tdPick-Up").hide();
        $(".tdCamión").hide();
        $(".tdOtro").hide();
      });
      $("#Pick-Up").click(function(){
        $(".tdAutomovil").hide();
        $(".tdFurgón").hide();
        $(".tdPick-Up").show();
        $(".tdCamión").hide();
        $(".tdOtro").hide();
      });
      $("#Camión").click(function(){
        $(".tdAutomovil").hide();
        $(".tdFurgón").hide();
        $(".tdPick-Up").hide();
        $(".tdCamión").show();
        $(".tdOtro").hide();
      });
      $("#Otro").click(function(){
        $(".tdAutomovil").hide();
        $(".tdFurgón").hide();
        $(".tdPick-Up").hide();
        $(".tdCamión").hide();
        $(".tdOtro").show();
      });
      $("#Todos").click(function(){
        $(".tdAutomovil").show();
        $(".tdFurgón").show();
        $(".tdPick-Up").show();
        $(".tdCamión").show();
        $(".tdOtro").show();
      });
    });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="bi bi-car-front-fill"></i> Vehículos 
                    <button id="Automovil" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-car-front-fill"></i></button>
                    <button id="Furgón" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-truck"></i></button>
                    <button id="Pick-Up" class="btn btn-secondary btn-sm mx-1"> <i class="bi bi-truck-flatbed"></i></button>
                    <button id="Camión" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-bus-front-fill"></i></button>
                    <button id="Otro" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-ev-front"></i></button>
                    <button id="Todos" class="btn btn-secondary btn-sm mx-1"><i class="bi bi-three-dots"></i></button>
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
                        <th>MODEL</th>
                        <th class="text-center">AÑO</th>
                        <th></th>
                        <th class="text-center">DOMINIO</th>
                        <th class="text-center"><i class="bi bi-pencil-square"></i></th>
                        <th class="text-center"><i class="bi bi-boxes"></i></th>
                        <th class="text-center"><i class="bi bi-card-checklist"></i></th>
                        <th class="text-center"><i class="bi bi-trash-fill"></i></th>
                    </thead>
                    <tbody>
                    @foreach ($vehiculo as $v)
                        <tr class="align-middle td{{$v->tipo}}">
                            <td class="text-center">{{$v->id}}</td>
                            <td class="text-center">
                                @switch($v->tipo)
                                @case('Automovil')
                                <i class="bi bi-car-front-fill"></i>@break
                                @case('Furgón')
                                <i class="bi bi-truck"></i>@break
                                @case('Pick-Up')
                                <i class="bi bi-truck-flatbed"></i>@break
                                @case('Camión')
                                <i class="bi bi-bus-front-fill"></i>@break
                                @case('Otro')
                                <i class="bi bi-ev-front"></i>@break
                                @endswitch
                            </td>
                            <td>{{$v->marca}}</td>
                            <td class="text-center">{{$v->modelo}}</td>
                            <td class="text-center">
                                <div class="
                                @if($v->fro==$v->frq)
                                text-success
                                @else
                                text-danger
                                @endif">
                                {{$v->fro}}/{{$v->frq}}
                                </div>
                            </td>
                            <td class="text-center">{{ Str::upper($v->patente) }}</td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#m{{$v->id}}"><i class="bi bi-pencil-square"></i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="m{{$v->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Editar {{$v->marca}}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('vehiculos.update', $v->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                        Modelo
                                        <input type="text" name="marca" class="form-control form-control-sm" value="{{$v->marca}}" maxlength="20">
                                        <div class="row">
                                            <div class="col">
                                                AÑO
                                                <input type="number" name="modelo" class="form-control form-control-sm" value="{{$v->modelo}}" maxlength="4">
                                            </div>
                                            <div class="col">
                                                Tipo
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tipo">
                                                <option {{ ( $v->tipo == "Automovil") ? 'selected' : '' }} value="Automovil">Automovil</option>
                                                <option {{ ( $v->tipo == "Furgón") ? 'selected' : '' }} value="Furgón">Furgón</option>
                                                <option {{ ( $v->tipo == "Pick-Up") ? 'selected' : '' }} value="Pick-Up">Pick-Up</option>
                                                <option {{ ( $v->tipo == "Camión") ? 'selected' : '' }} value="Camión">Camión</option>
                                                <option {{ ( $v->tipo == "Otro") ? 'selected' : '' }} value="Otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                        Dominio
                                        <input type="text" name="patente" class="form-control form-control-sm" value="{{$v->patente}}" maxlength="7">
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#s{{$v->id}}"><i class="bi bi-boxes"></i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="s{{$v->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Vincular Suceso a {{$v->marca}}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('vehsuc.store')}}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                        <input type="hidden" name="idVeh" value="{{$v->id}}">
                                        <div class="row">
                                            <div class="col">
                                                Suceso
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idSuc">
                                                    <option value="*">Ver todos</option>
                                                    @foreach ($suc as $s)
                                                <option value="{{$s->id}}">{{$s->nombresuc}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Aplicar</button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">
                                <a class="navbar-brand text-primary" href="{{route('sucapl.index',$v->id)}}">
                                <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-card-checklist"></i></button>
                                </a> 
                            </td>
                            <td class="text-center">
                                <form action="{{route('vehiculos.destroy', $v->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea Quitar  {{$v->marca}}?')"><i class="bi bi-trash-fill"></i></button>
                                    </form>    
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
                            <h6 class="modal-title" id="exampleModalLabel">Agregar Vehículo</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('vehiculos.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                            Modelo
                            <input type="text" name="marca" class="form-control form-control-sm" value="" placeholder="Marca / Modelo" maxlength="20">
                            <div class="row">
                                <div class="col">
                                    AÑO
                                    <input type="number" name="modelo" class="form-control form-control-sm" value="" maxlength="4" placeholder="AAAA">
                                </div>
                                <div class="col">
                                    Tipo
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tipo">
                                    <option value="Automovil">Automovil</option>
                                    <option value="Furgón">Furgón</option>
                                    <option value="Pick-Up">Pick-Up</option>
                                    <option value="Camión">Camión</option>
                                    <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            Dominio
                            <input type="text" name="patente" class="form-control form-control-sm" value="" placeholder="AA000BB" maxlength="7">
                            </div>
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
