<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="sidebar-mini">

    <?php
    $userGroups = getUserGroups();
    ?>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars fa-lg fa-2x"></i> MENÚ
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-circle fa-lg fa-2x"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider fixed-top"></div>
                        <br>
                        <div class="dropdown-divider"></div>
                        <br>

                        <div style="text-align:center">
                            <img src="{{ asset('img/user.png') }}" class="img-circle img-size-64 pull-right">

                            <span class="dropdown-item dropdown-header"><b>{{  Auth::user()->username }}</b></span>
                        </div>

                        <div class="dropdown-divider"></div>

                        <a href="{{route('usuarios.editarMiPerfil') }}" class="dropdown-item pull-left">
                            <i class="fa fa-address-card"></i> Editar Perfil
                        </a>

                        <a href="{{route('usuarios.editarMiPassword') }}" class="dropdown-item pull-left">
                            <i class="fa fa-lock"></i> Editar Contraseña
                        </a>

                        <a href="{{ route('logout') }}" class=" dropdown-item pull-right"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt"></i> Salir
                        </a>

                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">SIGEEVA</a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/user2-160x160.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{  Auth::user()->username }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                        {{-- OPCIONES FUERA DE GRUPOS --}}

                        @if(count(array_intersect($userGroups, ['docente'])) || count(array_intersect($userGroups, ['orientacion'])) || count(array_intersect($userGroups, ['coordinador_de_turno'])) )
                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Kiosko
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('kiosko.alumno.historial') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Alumno</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('solicitudes.estadisticas') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Estadisticas solicitudes</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif









                        {{-- M E N U   D O C E N T E --}}
                        @if(count(array_intersect($userGroups, ['docente'])))
                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Docente
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('docente.gruposAsignados') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Mis grupos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- M E N U   S E R V I C I O S   E S C O L A R E S --}}
                        @if( count(array_intersect($userGroups, ['servicio_escolar'])) )

                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Servicios escolares
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ route('bitacora') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Bitácora</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tools.paseDeLista') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Pase de lista</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('grupo.index') }}" class="nav-link">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Grupos</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('historicos.grupo.index') }}" class="nav-link">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Grupos (Histórico)</p>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{ route('solicitudes.estadisticas') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Estadisticas solicitudes</p>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{ route('usuarios.accesosAlumnos') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Accesos Alumnos</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('usuarios.accesosDocentes') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Accesos Docentes</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('usuarios.accesosAdministrativos') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Accesos Administrativos</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif

                        {{-- M E N U   A D M I N I S T R A D O R   D E L   S I S T E M A --}}

                        @if( count(array_intersect($userGroups, ['administrador_del_sistema'])) )
                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Plan de estudios
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ route('plandeestudios.asignaturas.index') }}" class="nav-link">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Asignaturas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- M E N U   C O N T R O L   E S C O L A R --}}
                        @if( count(array_intersect($userGroups, ['control_escolar'])) )
                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Control escolar
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('alumnos.index') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Alumnos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('controlescolar.grupo.index') }}" class="nav-link">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Grupos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('controlescolar.grupo.historico') }}" class="nav-link">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Grupos (Histórico)</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('solicitudes.concentrado') }}" class="nav-link">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Solicitudes</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif

                        {{-- M E N U   O R I E N T A C I O N --}}
                        @if( count(array_intersect($userGroups, ['orientacion'])) )
                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Orientación
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('grupo.index') }}" class="nav-link">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Grupos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- M E N U   T I T U L A C I O N --}}
                        @if( count(array_intersect($userGroups, ['titulacion'])) )
                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Titulación
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('grupo.index') }}" class="nav-link">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Grupos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{-- M E N U   R E C U R S O S   H U M A N O S --}}
                        @if( count(array_intersect($userGroups, ['rh'])) )

                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Recursos humanos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{ route('docentes.index') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Docentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('administrativos.index') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Administrativos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        @endif


                        @if( count(array_intersect($userGroups, ['administrador_del_sistema'])) )

                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Sistema
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('usuarios.index') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('groups.index') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Grupos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        @endif

                        @if( count(array_intersect($userGroups, ['alumno'])) )

                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Alumno
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">


                                    <li class="nav-item">
                                        <a href="{{ route('solicitudes.reinscripcion') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Solicitud Reinscripción</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('calificacion.index') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Calificaciones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        @endif



                        @if(count(array_intersect($userGroups, ['OTRO'])))

                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Personas ID {{ Auth::user()->id }}
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('personas.create') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('personas.index') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Listado</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        ServiciosEscolares
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('carreras.index') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Carreras</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview menu-close">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Sistema
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('users') }}" class="nav-link ">
                                            <i class="fas fa-circle-notch nav-icon"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        @endif





                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                                class="nav-link"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                >
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Salir</p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            <!-- /.sidebar-menu -->
            </div>
        <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="app">
            @yield('page-header')

            <div class="container">
                <div class="row" style="margin-top: 1em">
                    <div class="col-md-12">
                        @if (Session::get('msgGeneralError'))
                            <div class="alert alert-danger">
                                {{ Session::get('msgGeneralError') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @yield('content')

            @yield('modals')
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                SIGEEVA
            </div>

            <!-- Default to the left -->
            <strong>
                Copyright &copy; 2019-{{ date('Y') }} CEBT Eva Sámano de López Mateos.
            </strong> Todos los derechos reservados
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('jscripts')
</body>
</html>

