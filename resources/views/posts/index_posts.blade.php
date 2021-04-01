@extends('template')
@section('docker')
    <h3 class="tituloModulo"><i class="far fa-newspaper fa-lg"></i>Posts</h3>
    <hr>
    <form class="formBuscar" method="GET" action="{{ url('/posts/buscar') }}">                
        <label class="sr-only" for="inlineFormInputGroupUsername2">Título</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text">Título</div>
            </div>
            <input type="text" class="form-control" id="inlineFormInputGroupUsername2" name="textoBusqueda" value="{{ $textoBusqueda }}">
        </div>                                          
        <button type="submit" class="btn btn-primary mb-2">Buscar</button>
    </form>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/posts/crear') }}" class="btn btn-success btnAgregar"><i class="fas fa-plus"></i>Crear Post</a>
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-light">
                    <tr>                                                
                        <th scope="col">Acciones</th>
                        <th scope="col" width="50%">Título</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Portada</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($posts as $post)
                        <tr>                            
                            <td>{{ $post->title}}</td>
                            <td>{{ $post->slug}}</td>
                            <td><img src="{{url('storage/portadas')}}/{{ $post->image}}" width="50"></td>
                            <td>
                                <a href="{{ url('posts/mostrar') }}/{{ $post->id }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Visualizar Post" target="_blank"><i class="fas fa-desktop fa-lg"></i></a>
                                <a href="{{ url('posts/editar') }}/{{$post->id}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar Post"><i class="far fa-edit fa-lg"></i></a>
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Post" onclick="eliminarPost({{ $post->id }})"><i class="far fa-trash-alt fa-lg"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    @if(count($posts) == 0)
                        <tr>
                            <td colspan="5" style="text-align: center"><h4>No se encontrarón resultados</h4></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    </div>
    <form action="{{ URL('/posts/eliminar') }}" method="POST" id="form_delete" style="display: none;">
        @csrf
        <input type="hidden" name="post">
    </form>
@endsection
@section('scripts')

    <script>
        function eliminarPost(id)
        {
            if( confirm("¿Desea eliminar este Post?"))
            {  
                $("input[name=post]").val(id);
                $("#form_delete").submit();
            }
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection