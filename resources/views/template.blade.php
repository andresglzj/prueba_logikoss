<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboardTemplate.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg menu">
        <a class="navbar-brand" href="#">
            LogiKoos
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars fa-lg"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- aquí va el menú -->                
                <li class="nav-item logout">
                    <a class="nav-link" href="{{url('usuarios')}}"><i class="fas fa-users fa-lg"></i>Usuarios</a>
                </li>
                <li class="nav-item logout">
                    <a class="nav-link" href="{{url('posts')}}"><i class="fas fa-file-signature fa-lg"></i>Posts</a>
                </li>
                <li class="nav-item logout">
                    <a class="nav-link" href="#" alt="Cerrar Sesión" title="Cerrar Sesión" id="btn_logout"><i class="fas fa-sign-out-alt fa-lg"></i>Salir</a>
                </li>
            </ul>
          </div>
    </nav>
    <main>
        <div class="row" id="divDocker">
            <div class="col-md-12 capa">
                @section('docker')                    
                @show
            </div>
        </div>
    </main>
    <form action="{{ URL('logout') }}" method="POST" id="form_logout" style="display: none;">
        @csrf
    </form>
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="https://kit.fontawesome.com/9d72892313.js"></script>
	<script type="text/javascript">
		$("#btn_logout").click(function ()
			{
				if( confirm("¿Desea Cerrar su Sesión?"))
				{
					$("#form_logout").submit();
				}
			});
    </script>
    @yield('scripts')
</body>
</html>