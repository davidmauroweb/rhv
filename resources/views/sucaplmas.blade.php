@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Carga masiva de sucesos para : <b>
                    {{$ent->id}} - {{$ent->nombre}}</b>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div>
                            <form action="{{route('sucapl.storemas')}}" method="post">
                                @csrf
                                <input hidden value="{{$ent->id}}" name="idEmp">
                                <div class="row mb-2 mx-3">
                                Suceso
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="idSuc">
                                        @foreach ($lsuc as $l)
                                        <option value="{{$l->id}}">{{$l->nombresuc}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <div class="row mt-2 mb-4 mx-2">
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
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
