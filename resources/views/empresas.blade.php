@extends('layouts.app')

@section('content')
<script>
    $(document).ready(function(){
   
});

function lista(emp){
  
    $.ajax({
        url: '/empper/' + emp ,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var rows = '';
            if(data.length > 0) {
                $.each(data, function(i, personas){
                rows+= '<tr><td>' + personas.suceso + '</td><td class="px-3">' + personas.persona + '</td><td class="px-3">' + personas.estado + '</td></tr>'; 
                });
            }
            $('#tab').html(rows);
        }  
    })
}

function listap(emp){
  
  $.ajax({
      url: '/empperp/' + emp ,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
          var rows = '';
          if(data.length > 0) {
              $.each(data, function(i, personas){
              rows+= '<tr><td><form action="/empper/' + personas.id + '" method="post"> @csrf @method("delete") <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(`¿Desea Quitar el vínculo?`)"><i class="bi bi-trash-fill"></i></button></form></td><td>' + personas.nombre + '</td></tr>'; 
              });
          }
          $('#tabp').html(rows);
      }  
  })
} 
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="bi bi-buildings-fill"></i> Empresas</div>

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
                        <th>NOMBRE</th>
                        <th>CUIT</th>
                        <th><i class="bi bi-people-fill"></i></th>
                        <th></th>
                        <th></th>
                        <th><i class="bi bi-card-checklist"></i></th>
                        <th>RESUMEN</th>
                        <th><i class="bi bi-pencil-square"></i></th>
                        <th><i class="bi bi-ui-checks"></i></th>
                        <th>ESTADO</th>
                    </thead>
                    <tbody>
                    @foreach ($empresa as $e)
                        <tr class="align-middle">
                            <td>{{$e->id}}</td>
                            <td>{{$e->nombre}}</td>
                            <td>{{$e->cuit}}</td>
                            <td>{{$e->q_personas}}</td>

                            <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mlisp" onClick="listap({{$e->id}})" title="Lista de Personal">
                                <i class="bi bi-people-fill"></i>
                                </button>
                                <div class="modal fade" id="mlisp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Personal</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table  class="table table-sn table-hover">
                                                <tbody id="tabp">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td>
                            <a class="navbar-brand text-primary" href="{{route('sucapl.showmas',$e->id)}}">
                                    <button type="button" class="btn btn-primary btn-sm" title="Carga masiva de evento al personal de {{$e->nombre}}"><i class="bi bi-card-checklist"></i></button>
                            </a>
                            </td>
                            <td >{{$e->q_sucesos}}</td>
                            <td>@php echo $e->x; @endphp</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#m{{$e->id}}" title="Editar Empresa"><i class="bi bi-pencil-square"></i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="m{{$e->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Editar {{$e->nombre}}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('empresas.update', $e->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                        Nombre
                                        <input type="text" name="nombre" class="form-control form-control-sm" value="{{$e->nombre}}" maxlength="20">
                                        <div>
                                                CUIT
                                                <input type="text" name="cuit" class="form-control form-control-sm" value="{{$e->cuit}}" maxlength="13">
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
                                <a class="navbar-brand text-primary" href="{{route('empsuc.index',$e->id)}}">
                                    <button type="button" class="btn btn-primary btn-sm" title="Eventos Solicitados"><i class="bi bi-ui-checks"></i></button>
                                </a>  
                            </td>
                            <td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mlis" onClick="lista({{$e->id}})" title="Estado de eventos">
                                <i class="bi bi-person-fill-check"></i>
                                </button>
                                <div class="modal fade" id="mlis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Sucesos del personal de {{$e->nombre}}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table  class="table table-sn table-hover">
                                                <tbody id="tab">
                                                </tbody>
                                            </table>
                                        </div>
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
                            <h6 class="modal-title" id="exampleModalLabel">Agregar Empresa</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('empresas.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                Nombre
                                <input type="text" name="nombre" class="form-control form-control-sm" value="" placeholder="Nombre" maxlength="20">
                                <div>
                                        CUIT
                                        <input type="text" name="cuit" class="form-control form-control-sm" value="" placeholder="XX-XXXXXXXX-X" maxlength="13">
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
