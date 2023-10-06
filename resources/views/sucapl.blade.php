@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de Sucesos para : <b>
                    @foreach($ent as $e)
                    @if(isset($e->nombre))
                        {{$e->nombre}}
                    @endif
                    @if(isset($e->marca))
                    {{$e->tipo}} - {{$e->marca}}
                    @endif
                    @endforeach</b>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-sn table-hover">
                    <thead>
                        <th>SUCESO</th>
                        <th>VENCIMIENTO</th>
                        <th><i class="bi bi-trash-fill"></i></th>
                    </thead>
                    <tbody>
                    @foreach ($sucapl as $s)
                        <tr class="align-middle
                        @if($s->days < 0)
                        table-danger
                        @elseif($s->days < $s->vigencia)
                        table-warning
                        @else
                        @endif
                        ">
                            <td>{{$s->nombresuc}}</td>
                            <td>{{date("d/m/Y", strtotime($s->vence))}}
                                 en {{$s->days}} días
                            </td>
                            <td>
                                @foreach($ent as $e)
                                <form action="{{route('sucapl.destroy', $s->idsucapl)}}" method="post">
                                @endforeach
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea Quitar  {{$s->nombresuc}}?')"><i class="bi bi-trash-fill"></i></button>
                                </form> </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="card-footer">
                            <form action="{{route('sucapl.store')}}" method="post">
                                @csrf
                                @foreach($ent as $e)
                                @if(isset($e->nombre))
                                <input hidden value="{{$e->id}}" name="idPer">
                                @endif
                                @if(isset($e->marca))
                                <input hidden value="{{$e->id}}" name="idVeh">
                                @endif
                                @endforeach
                                Suceso
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idSuc">
                                        @foreach ($lsuc as $l)
                                        <option value="{{$l->id}}">{{$l->nombresuc}}</option>
                                        @endforeach
                                        </select>
                                <div class="row mt-2 mb-2">
                                    <div class="col">
                                        Fecha
                                        <span class="datepicker-container">
                                            <input type="date"
                                                   class="datepicker-input form-control"
                                                   name="fecha"
                                                   value="{{date('d-m-Y')}}" required>
                                          </span>
                                    </div>
                                    <div class="col">
                                        Vence
                                        <span class="datepicker-container">
                                            <input type="date"
                                                   class="datepicker-input form-control"
                                                   name="vence"
                                                   value="" required>
                                          </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
