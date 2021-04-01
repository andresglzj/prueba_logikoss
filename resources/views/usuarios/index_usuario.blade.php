@extends('template')
@section('docker')
    <h3 class="tituloModulo"><i class="fas fa-user-tie fa-lg"></i>Usuarios</h3>
    <hr>
    <form class="form-inline formBuscar" method="GET" action="{{ url('/usuarios/buscar') }}">        
        <label class="sr-only" for="inlineFormInputGroupUsername2">Nombre</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user-tag fa-lg"></i></div>
            </div>
            <input type="text" class="form-control" id="inlineFormInputGroupUsername2" name="textoBusqueda" value="{{ $textoBusqueda }}">
        </div>                                          
        <button type="submit" class="btn btn-primary mb-2">Buscar</button>
    </form>
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <a href="{{ url('/usuarios/crear') }}" class="btn btn-success btnAgregar"><i class="fas fa-plus"></i>Agregar Usuario</a>
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Acciones</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Cumpleaños</th>
                        
                    </tr>
                </thead>
                <tbody>                    
                    @foreach($usuarios as $usuario)
                    <tr>
                            <td>
                                <button type="button" onclick="getUsuario({{$usuario->id}})" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="far fa-address-card fa-lg"></i></button>
                                <a href="{{ url('/usuarios/editar') }}/{{$usuario->id}}" class="btn btn-warning"><i class="far fa-edit fa-lg" style="color: black;"></i></a>
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Usuario" onclick="eliminarUsuario({{ $usuario->id }})"><i class="far fa-trash-alt fa-lg"></i></a>
                            </td>
                            <td>{{ $usuario->id}}</td>
                            <td>{{ $usuario->name}}</td>
                            <td>{{ $usuario->email}}</td>
                            <td><img src="{{ url('storage/avatares') }}/{{$usuario->avatar}}" width="50"></td>
                            <td>{{ $usuario->birthday}}</td>
                        </tr>                        
                    @endforeach
                    @if(count($usuarios) == 0)
                        <tr>
                            <td colspan="5" style="text-align: center"><h4>No se encontrarón resultados para la búsqueda</h4></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{ $usuarios->links() }}
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Datos del Usuario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>              
            </div>
          </div>
        </div>
      </div>
    <form action="{{ URL('/usuarios/eliminar') }}" method="POST" id="form_delete" style="display: none;">
        @csrf
        <input type="hidden" name="usuario">
    </form>
@endsection
@section('scripts')
    <script>
        function eliminarUsuario(id)
        {
            if( confirm("¿Desea eliminar este Usuario?"))
            {  
                $("input[name=usuario]").val(id);
                $("#form_delete").submit();
            }
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        function getUsuario(id){
            $.get( "{{url('usuarios')}}/mostrar/"+id, function( data ) {
                    var datos = "<p><strong>Id:</strong> "+data.id+"</p>";
                    datos += "<p><strong>Nombre:</strong> "+data.name+"</p>";
                    datos += "<p><strong>Usuario:</strong> "+data.username+"</p>";
                    datos += "<p><strong>Nacimiento:</strong> "+data.birthday+"</p>";
                    datos += "<p><strong>Avatar:</strong><img src='{{url('storage/avatares')}}/"+data.avatar+"' width='100'></p>";

                    $(".modal-body").html(datos);
            });
        }
    </script>
@endsection