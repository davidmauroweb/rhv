@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de Sucesos para : <b>
                    @foreach($ve as $e)
                    {{$e->tipo}} - {{$e->marca}} - {{$e->patente}}
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
                        <th>SUCESOS</th>
                        <th><i class="bi bi-trash-fill"></i></th>
                    </thead>
                    <tbody>
                    @foreach ($ls as $s)
                        <tr class="align-middle">
                            <td>{{$s->nombresuc}}</td>
                            <td>
                                <form action="{{route('vehsuc.destroy', $s->idvehsuc)}}" method="post">
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
                    <form action="{{route('vehsuc.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="idVeh" value="{{$e->id}}">
                        <div class="row">
                            <div class="col-5">
                                Agregar
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idSuc">
                                @foreach ($suc as $s)
                                <option value="{{$s->id}}">{{$s->nombresuc}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
