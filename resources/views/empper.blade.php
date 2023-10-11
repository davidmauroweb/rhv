@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de Sucesos para  <b>
<form action="{{route('empper.store')}}" method="post">
    @csrf

                    @foreach($per as $p)
                        {{$p->nombre}} <input type="hidden" name="idPer" value="{{$p->id}}">
                    @endforeach
                </b> aplicado a <b>
                    @foreach($emp as $e)
                        {{$e->nombre}}<input type="hidden" name="idEmp" value="{{$e->id}}">
                    @endforeach
                </b> <button type="submit" class="btn btn-success btn-sm">Vincular</button>
</form>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-sn table-hover">
                    <thead>
                        <th>Estado</th>
                    </thead>
                    <tbody>
                    @foreach ($empsuc as $es)
                        <tr class="align-middle">
                            <td>@php echo $es->estado @endphp</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
