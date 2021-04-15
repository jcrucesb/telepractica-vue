<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/img/telepractica-logo-16x16.png" />

    <title>
        @yield('title')
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?vr" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('estilos')

</head>

<body>
    <div class="wrapper" > 
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/admin-home" class="nav-link">Inicio</a>
                </li>
            </ul>
    
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        Cerrar sesión
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
    
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin-home" class="brand-link">
                <img src="{{ '/img/telepractica-logo-32x32.png' }}" alt="Telepráctica Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Telepráctica</span>
            </a>
    
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ '/img/user-32x32.png' }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('user.profile') }}" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>
    
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                        <li class="nav-item menu-is-opening menu-open">
                            <a href="#" class="nav-link active">
                                <i class="fas fa-bars fa-lg"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                                
                            <ul class="nav nav-treeview" style="display: block;">
                                @if (auth()->user()->can('admin.home'))
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <i class="fas fa-users fa-sm"></i>
                                        <p>Cuentas</p>
                                    </a>
                                </li>
                                @endif
                                <!--Solo se mostrará esta opción al ADMINISTRADOR.-->
                                @if (auth()->user()->can('admin.home'))
                                <li class="nav-item">
                                    <a href="{{ route('practicante.index') }}" class="nav-link">
                                        <i class="fas fa-user-graduate fa-sm"></i>
                                        <p>Practicantes</p>
                                    </a>
                                </li>
                                @endif
                                <!---->
                                <!--Solo se mostrará esta opción al ADMINISTRADOR.-->
                                @if (auth()->user()->can('admin.home'))
                                <li class="nav-item">
                                    <a href="{{ route('empresa.index') }}" class="nav-link">
                                        <i class="fas fa-user-tie fa-sm"></i>
                                        <p>Empresas</p>
                                    </a>
                                </li>
                                @endif
                                <!--EMPRESAS.-->
                                @if (auth()->user()->can('empresas.index'))
                                <li class="nav-item">
                                    <a href="{{ route('empresa.index') }}" class="nav-link">
                                        <i class="fas fa-user-tie fa-sm"></i>
                                        <p>Empresas</p>
                                    </a>
                                </li>
                                @endif
                                <!---->
                                <!--EMPRESAS, mostrar todos los practicantes que aceptaron la citación
                                    de la entrevista.-->
                                @if (auth()->user()->can('empresas.index'))
                                <li class="nav-item">
                                    <a href="{{ route('confirmacionEntrevistaPracticantes') }}" class="nav-link">
                                        <i class="fas fa-user-tie fa-sm"></i>
                                        <p>Aceptaron Entrevista</p>
                                    </a>
                                </li>
                                @endif
                                <!---->
                                <!--EMPRESAS, mostrar todos los practicantes que aceptaron la citación
                                    de la entrevista.-->
                                    @if (auth()->user()->can('empresas.index'))
                                    <li class="nav-item">
                                        <a href="{{ route('datosEmpresa') }}" class="nav-link">
                                            <i class="fas fa-user-tie fa-sm"></i>
                                            <p>Datos Empresa</p>
                                        </a>
                                    </li>
                                    @endif
                                    <!---->
                                <!---->
                                @if (auth()->user()->can('admin.home'))
                                <li class="nav-item">
                                    <a href="{{ route('institucion.index') }}" class="nav-link">
                                        <i class="fas fa-university fa-sm"></i>
                                        <p>Instituciones</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>

                        <li class="nav-item menu-is-opening menu-open">
                            <a href="#" class="nav-link active">
                                <i class="fas fa-bars fa-lg"></i>
                                <p>
                                    Otros
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
    
                            <ul class="nav nav-treeview" style="display: block;">
                                <!---->
                                @if (auth()->user()->can('admin.home'))
                                <li class="nav-item">
                                    <a href="{{ route('carrera.index') }}" class="nav-link">
                                        <i class="fas fa-graduation-cap"></i>
                                        <p>Carreras</p>
                                    </a>
                                </li>
                                @endif
                                <!---->
                                @if (auth()->user()->can('admin.home'))
                                <li class="nav-item">
                                    <a href="{{ route('comuna.index') }}" class="nav-link">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <p>Comunas</p>
                                    </a>
                                </li>
                                @endif
                                @if (auth()->user()->can('admin.home'))
                                <li class="nav-item">
                                    <a href="{{ route('oferta.index') }}" class="nav-link">
                                        <i class="fas fa-briefcase"></i>
                                        <p>Ofertas</p>
                                    </a>
                                </li>
                                @endif
                                @if (auth()->user()->can('practicante.index'))
                                <li class="nav-item">
                                    <a href="{{ route('practicante.index') }}" class="nav-link">
                                        <i class="fas fa-briefcase"></i>
                                        <p>Ofertas</p>
                                    </a>
                                </li>
                                @endif
                <!--Esta ruta es para mostrar los datos del PRACTICANTE y los pueda
                                EDITAR a gusto, Jair.-->
                                @if (auth()->user()->can('practicante.index'))
                                <li class="nav-item">
                                    <a href="{{ route('datosPersonales') }}" class="nav-link">
                                        <i class="fas fa-briefcase"></i>
                                        <p>Datos Personales</p>
                                    </a>
                                </li>
                                @endif
                                <!--Curriculum.-->
                                @if (auth()->user()->can('practicante.index'))
                                <li class="nav-item">
                                    <a href="{{ route('curriculumPract') }}" class="nav-link">
                                        <i class="fas fa-briefcase"></i>
                                        <p>Tu curriculum</p>
                                    </a>
                                </li>
                                @endif
                                <!---->
                                <!--Links para los certificados del Practicante.-->
                                @if (auth()->user()->can('practicante.index'))
                                <li class="nav-item">
                                    <a href="{{ route('certificadoPracticante') }}" class="nav-link">
                                        <i class="fas fa-briefcase"></i>
                                        <p>Certificados de Cursos</p>
                                    </a>
                                </li>
                                @endif
                                <!---->
                                @if (auth()->user()->can('admin.home'))
                                <li class="nav-item">
                                    <a href="{{ route('postulacion.index') }}" class="nav-link">
                                        <i class="fas fa-tasks"></i>
                                        <p>Postulaciones</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-question-circle fa-lg"></i>
                                <p>
                                    Ayuda
                                    <span class="right badge badge-danger">Nuevo</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
    
            </div>
            <!-- /.sidebar -->
        </aside>
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 249px;">
    
            @include('admin.partials.alert')
    
            @yield('content-admin')
            
        </div>
        <!-- /.content-wrapper -->
    
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->
    
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Telepráctica
            </div>
            <!-- Default to the left -->
            <strong>Telepráctica <a href="https://telepractica-vue.com:7070/admin-home">telepractica-vue.com</a>.</strong> Todos
            los derechos reservados.
        </footer>
        <div id="sidebar-overlay"></div>
    </div>    
</body>

@yield('scripts')

</html>
