@extends('template')
@section('styles')
    <style>
        
        .form-group{
            margin-top: 20px !important;
        }

        form .invalid-feedback{
            font-size: 14px !important;
        }

        form{
            margin-bottom: 30px;
        }
    </style>
@endsection
@section('docker')
    <h3 class="tituloModulo"><i class="fas fa-user-tie fa-lg"></i>Agregar Usuario</h3>
    <hr>    
    <div class="row">
        <div class="col-md-8 centrar">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form action="{{ url('/usuarios/actualizar') }}/{{$usuario->id}}" method="POST" enctype="multipart/form-data">
                @csrf                
                <div class="form-group row">
                    <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-md-10 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control @error('usuario') is-invalid @enderror" name="nombre" id="inputNombre" placeholder="Nombre Completo" value="{{ old('nombre',$usuario->name) }}" required>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputUsuario" class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-md-10 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" id="inputUsuario" placeholder="Nombre de Usuario" value="{{ old('usuario',$usuario->userName) }}" required>
                            @error('usuario')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-md-8 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword" placeholder="Contraseña" value="{{ old('password') }}" @if(!old('cambiar')) disabled @endif>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                        
                    </div>
                    <div class="col-md-2">
                        <input class="form-check-input" type="checkbox" name="cambiar" @if(old('cambiar')) checked @endif><span>Cambiar</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Correo Electrónico</label>
                    <div class="col-md-10 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" id="inputEmail" placeholder="Correo Electrónico" value="{{ old('correo',$usuario->email) }}" required>
                            @error('correo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNacimiento" class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
                    <div class="col-md-10 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="date" class="form-control @error('nacimiento') is-invalid @enderror" name="nacimiento" id="inputNacimiento"  value="{{ old('nacimiento',$usuario->birthday) }}" required>
                            @error('nacimiento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputAvatar" class="col-sm-2 col-form-label">Avatar</label>
                    <div class="col-md-10 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="file" accept="image/*" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="inputAvatar">
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary offset-md-8">Actualizar</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/usuarios') }}" class="btn btn-link">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("input[name=cambiar]").change(function(){                
            $("input[type=password]").prop("disabled",!$("input[name=password]").prop("disabled"));
        });
    });
</script>
@endsection