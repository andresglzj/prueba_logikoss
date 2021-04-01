@extends('template')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">    
@endsection
@section('docker')
    <div id="fb-root"></div>    
    <div class="row">
        <div class="col-md-10 centrar">
            <h2>{{ $post->titulo}}</h2>            
            <center>
                <img src="{{ url('storage/portadas')}}/{{ $post->image }}">
            </center>            
            {!! $post->content !!}
        </div>
    </div>
@endsection
@section('scripts')
        <script>
            $(document).ready(function(){
                $("img").parent().css("text-align", "center");
                $("img").addClass("img-responsive");
                $("img").css("max-width", "100%");
            });
        </script>        
@endsection