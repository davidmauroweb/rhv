@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="bi bi-people-fill"></i> RRHH</div>

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
                        <th></th>
                        <th>NOMBRE</th>
                        <th>DNI</th>
                        <th>SEXO</th>
                        <th>INGRESO</th>
                        <th></th>
                        <th class="text-center"><i class="bi bi-pencil-square"></i></th>
                        <th><i class="bi bi-card-checklist"></i></th>
                        <th>EMPRESAS</th>
                        <th class="text-center"><i class="bi bi-clipboard-plus"></i></th>
                        <th class="text-center"><i class="bi bi-trash-fill"></i></th>
                    </thead>
                    <tbody>
                    @foreach ($persona as $p)
                        <tr class="align-middle">
                            <td>{{$p->id}}</td>
                            <td class="text-center">
                                @if($p->activo==false)
                                <i class="bi bi-person-fill-slash text-danger"></i>
                                @else
                                <i class="bi bi-person-check-fill text-success"></i>
                                @endif
                            </td>
                            <td>{{$p->nombre}}</td>
                            <td>{{$p->dni}}</td>
                            <td>
                                @if($p->sx==0)
                                Masc.
                                @else
                                Fem.
                                @endif
                            </td>
                            <td>{{date("d/m/Y", strtotime($p->ingreso))}}</td>
                            <td class="text-center
                                @if($p->f==$p->r)
                                text-success
                                @else
                                text-danger
                                @endif">
                                {{$p->f}}/{{$p->r}}
                            </td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#m{{$p->id}}" title="Editar"><i class="bi bi-pencil-square"></i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="m{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Editar {{$p->nombre}}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('personas.update', $p->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                        Nombre
                                        <input type="text" name="nombre" class="form-control form-control-sm" value="{{$p->nombre}}" maxlength="20">
                                        <div class="row">
                                            <div class="col">
                                                DNI
                                                <input type="number" name="dni" class="form-control form-control-sm" value="{{$p->dni}}" maxlength="8" placeholder="DNI sin .">
                                            </div>
                                            <div class="col">
                                                Sexo
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="sx">
                                                <option {{ ( $p->sx == "0") ? 'selected' : '' }} value="0">Masculino</option>
                                                <option {{ ( $p->sx == "1") ? 'selected' : '' }} value="1">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <div class="col">Ingreso
                                            <span class="datepicker-container">
                                                <input type="date"
                                                    class="datepicker-input form-control"
                                                    name="ingreso"
                                                    value="{{$p->ingreso}}">
                                            </span>
                                            </div>
                                            <div class="col">
                                                Activo
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="activo" id="activo" @if($p->activo==1)checked @endif value="1">

                                                      Activo

                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="activo" id="Baja" @if($p->activo==0)checked @endif value="0">

                                                      Inactivo

                                                  </div>
                                            </div>
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
                            <td>
                                <a class="navbar-brand text-primary" href="{{route('sucapl.show',$p->id)}}">
                                    <button type="button" class="btn btn-primary btn-sm" title="Lista de eventos"><i class="bi bi-card-checklist"></i></button>
                                </a> 
                            </td>

                            <td>{{$p->empresas}}</td>

                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#e{{$p->id}}" title="Analizar"
                                    @if($p->activo==0)
                                    disabled
                                    @endif                                    
                                    ><i class="bi bi-clipboard-plus"></i></button>
                                <!-- Modal para aplicar empresa -->
                                <div class="modal fade" id="e{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{route('empper.show')}}" method="post">
                                            @csrf
                                            <div class="modal-header">
                                                Analizar {{$p->nombre}} con la Empresa:
                                            </div>
                                            <div class="modal-body">
                                            <input type="hidden" name="idPer" value="{{$p->id}}">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idEmp">
                                                @foreach ($empresas as $e)
                                                    <option value="{{$e->id}}">{{$e->nombre}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">Analizar</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <form action="{{route('personas.destroy', $p->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea Quitar a  {{$p->nombre}}?')" title="Eliminar"
                                        @if($p->activo==0)
                                        disabled
                                        @endif
                                        ><i class="bi bi-trash-fill"></i></button>
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
                            <h6 class="modal-title" id="exampleModalLabel">Agregar RRHH</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('personas.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                            Nombre
                            <input type="number" name="nombre" class="form-control form-control-sm" value="" placeholder="Nombre" maxlength="20">
                            <div class="row">
                                <div class="col">
                                    DNI
                                    <input type="number" name="dni" class="form-control form-control-sm" value="" placeholder="DNI sin ." maxlength="8">
                                </div>
                                <div class="col">
                                    Sexo
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="sx">
                                    <option value="0">Masculino</option>
                                    <option value="1">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            Ingreso
                            <div>
                            <span class="datepicker-container">
                                <input type="date"
                                       class="datepicker-input form-control"
                                       name="ingreso"
                                       value="">
                              </span>
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
