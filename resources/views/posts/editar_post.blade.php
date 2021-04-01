@extends('template')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">    

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
<h3 class="tituloModulo"><i class="far fa-newspaper fa-lg"></i>Editar Boletin</h3>
    <hr>     
    <div class="row">
        <div class="col-md-10 centrar">
            <form action="{{ url('/dashboard/boletines/actualizar') }}/{{ $boletin->id }}" method="POST" enctype="multipart/form-data">
                @csrf                                
                <div class="form-group row">
                    <label for="inputTitulo" class="col-sm-2 col-form-label">Título</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-pencil-alt fa-lg"></i></span>
                            </div>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="inputTitulo" placeholder="Título del Boletín" value="{{ old('titulo', $boletin->titulo) }}" required>
                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputFecha" class="col-sm-2 col-form-label">Fecha</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-calendar-day fa-lg"></i></span>
                            </div>
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" id="inputFecha" placeholder="Título del Boletín" value="{{ old('fecha', $boletin->fecha_boletin) }}" required>
                            @error('fecha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Portada</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-image fa-lg"></i></span>
                            </div>
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile" id="labelPdf">Seleccionar Foto</label>
                                <input type="file" class="custom-file-input @error('portada') is-invalid @enderror" name="portada" accept="image/jpg,image/jpeg" id="customFile" lang="es">                        
                                @error('portada')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                                
                            </div>                            
                        </div>
                        <small class="form-text text-muted"><a href="{{ url('storage/boletines') }}/{{$boletin->foto_portada}}" target="_blank">{{$boletin->foto_portada}}</a></small>                 
                    </div>                    
                </div>
                <div class="form-group row">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Tipo</label>
                    <div class="col-md-10 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-clipboard-check fa-lg"></i></span>
                            </div>
                            <select class="custom-select @error('tipo') is-invalid @enderror" name="tipo" required>                                
                                <option value="">Seleccionar</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" @if(old('tipo',$boletin->id_tipo_boletin) == $tipo->id) selected @endif> {{ $tipo->descripcion }}  </option>
                                @endforeach
                            </select>
                            @error('tipo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-md-10 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-toggle-on fa-lg"></i></span>
                            </div>
                            <select class="custom-select @error('status') is-invalid @enderror" name="status" required>                                
                                <option value="1" @if($boletin->status == 1) selected @endif>Publicado</option>
                                <option value="2" @if($boletin->status == 1) selected @endif>Borrador</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                        
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md">
                        <label for="summernote" class="col-sm-2 col-form-label">Contenido</label>                        
                        <textarea id="summernote" name="contenido"> {{ $boletin->contenido}}</textarea> 
                        @error('contenido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>                    
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary offset-md-8">Guardar</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('dashboard/boletines') }}" class="btn btn-link">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>    
    <script>
    $(document).ready(function(){
        $('#summernote').summernote({
        placeholder: 'Redacta el contenido del boletín',
        tabsize:2,
        height: 500,
        
      });
    });        
    </script>
@endsection