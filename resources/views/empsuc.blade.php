@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Listado de Sucesos para la Empresa <b>@foreach($emp as $e) {{$e->nombre}} @endforeach</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-sn table-hover">
                    <thead>
                        <th>#</th>
                        <th>SUCESOS</th>
                        <th><i class="bi bi-trash-fill"></i></th>
                    </thead>
                    <tbody>
                    @foreach ($empsuc as $s)
                        <tr class="align-middle">
                            <td>{{$s->id}}</td>
                            <td>{{$s->nombresuc}}</td>
                            <td><form action="{{route('empsuc.destroy', $s->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea Quitar  {{$s->nombre}}?')"><i class="bi bi-trash-fill"></i></button>
                                </form> </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="card-footer">
                            <form action="{{route('empsuc.store')}}" method="post">
                                @foreach($emp as $e)
                                <input hidden value="{{$e->id}}" name="idEmp">
                                @endforeach
                            @csrf
                                Suceso
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idSuc">
                                        @foreach ($lsuc as $l)
                                        <option value="{{$l->id}}">{{$l->nombresuc}}</option>
                                        @endforeach
                                        </select>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
