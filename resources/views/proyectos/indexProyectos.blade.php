
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proyecto</title>
</head>

<body>

<header>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <div class="container">
                
            <!-- Navbar Brand-->
            @if (Route::has('login'))
                @auth
                <a class="navbar-brand ps-3" href="/" style="color:#51ff00; font-size: 15px;">Home</a>
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <a class="navbar-brand ps-3" href="{{ url('/profile') }}" style="color:#51ff00; font-size: 15px;">{{ Auth::user()->name }} {{ Auth::user()->apellido }}</a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="navbar-brand ps-3" href="{{route('proyecto.index')}}" style="color:#050505; font-size: 15px;"">Mis Proyectos</a></li>
                        <li><a class="navbar-brand ps-3" href="{{route('proyecto.create')}}" style="color:#050505; font-size: 15px;"">Crear Proyecto</a></li>
                        <li><form method="POST" action="{{route('logout')}}">
                            @csrf
                            <a class="navbar-brand ps-3" href="{{route('logout')}}" onclick="event.preventDefault();
                            this.closest('form').submit(); " style="color:#050505; font-size: 15px;"">Cerrar sesión</a>
                            </form>  
                        </li>  
                    </ul>
                </li>
            </ul>
                @else
                <div class="main-menu d-none d-md-block ps-3">
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
                </div>
          @endif
          </div>
        </nav>
  </body>


</header>


    <script>
	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="./assets/js/gijgo.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

        <!-- Breaking New Pluging -->
        <script src="./assets/js/jquery.ticker.js"></script>
        <script src="./assets/js/site.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        @if(session('crear')=='ok')
        <script>
            Swal.fire(
            'Registro completo!',
            'Tu proyecto se creó con éxito',
            'success')
        </script>
        @endif

        @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
            'Eliminado!',
            'Tu proyecto se eliminó con éxito',
            'success')
        </script>
        @endif
        
        @if(session('editar')=='ok')
        <script>
            Swal.fire(
            'Editado!',
            'Tu proyecto se actualizó con éxito',
            'success')
        </script>
        @endif
    </body>
</html>


<main>
        <!-- About US Start -->
        <div class="about-area">
            <div class="container">
                   <div class="row">
                        <div class="col-lg-10">
                            <!-- Trending Tittle -->
                            <div class="about-right mb-90">
                                
                            <h1 class="p-4 text-info text-center">Mi listado de proyectos</h1>
                            <!--<a href="proyectos/create">Añadir proyecto</a> <a href="index">Inicio</a>-->
                                <div class="conteiner-fluid" >
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tr class="p-3 mb-2 bg-info text-white">
                                            <th>ID</th>
                                            <th>Titulo</th>
                                            <th>Descripcion</th>
                                            <th>Abstracto</th>
                                            <th>Fecha</th>
                                        <th style="width:10px;"> Acciones </th>
                                        </tr>
                                        @foreach ($proyectos as $proyecto)
                                        <tr>
                                            <td>{{$proyecto->id}}</td>
                                            <td>{{$proyecto->titulo}}</td>
                                            <td>{{$proyecto->descripcion}}</td>
                                            <td>{{$proyecto->abstracto}}</td>
                                            <td>{{$proyecto->fecha}}</td>
                                            <td> <a href="proyecto/{{$proyecto->id}}" class="btn btn-success text-white m-1">Detalles</a>
                                                <a href="proyecto/{{$proyecto->id}}/edit" class="btn btn-primary text-white  m-1">Editar</a>
                                                <form id="{{$proyecto->id}}" action="proyecto/{{$proyecto->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="button" class="btn btn-danger active" onclick="detener(event, {{$proyecto->id}});" value="Borrar"> 
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                </div>
                                </div>
                        </div>
                        
                   </div>
            </div>
        </div>
        <!-- About US End -->
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if(session('crear')=='ok')
        <script>
            Swal.fire(
            'Registro completo!',
            'Tu proyecto se creó con éxito',
            'success')
        </script>
        @endif

        @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
            'Eliminado!',
            'Tu proyecto se eliminó con éxito',
            'success')
        </script>
        @endif
        
        @if(session('editar')=='ok')
        <script>
            Swal.fire(
            'Editado!',
            'Tu proyecto se actualizó con éxito',
            'success')
        </script>
        @endif

        <script type="text/javascript">
        function detener(evt, contenedor){
            evt.preventDefault();
            Swal.fire({
            title: '¿Está seguro?',
            text: "Este libro se eliminará definitivamente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(contenedor).submit();
                //document.queryselector.All();
            }
            })


        };
        </script>
