<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MPLC007 - Personal</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!--link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"-->
    <link href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-users"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PERSONAL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @hasanyrole('Admin|Nivel 1|Nivel 2')
            <li class="nav-item">
                <a class="nav-link" href="{{route('biometricos.index')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Biométricos</span></a>
            </li>
            @endhasanyrole
            @hasanyrole('Admin|Nivel 1|Nivel 2')
            <li class="nav-item">
                <a class="nav-link" href="{{route('employees.index')}}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Personal</span></a>
            </li>
            @endhasanyrole       

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Asistencia
            </div>
            @hasanyrole('Admin|Nivel 1|Nivel 2')
            <!--li class="nav-item">
                <a class="nav-link" href="{{route('at')}}">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Oficinas</span></a>
            </li-->
            @endhasanyrole
            @hasanyrole('Admin|Nivel 1|Nivel 2')
            <li class="nav-item">
                <a class="nav-link" href="{{route('schedules.index')}}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Horarios</span></a>
            </li>
            @endhasanyrole

            @hasanyrole('Admin|Nivel 1|Nivel 2')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#operacionesAsistencia" aria-expanded="true" aria-controls="operacionesAsistencia">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Operaciones</span>
                </a>
                <div id="operacionesAsistencia" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
                    <div class="bg-light py-2 collapse-inner rounded text-white">
                        <a class="collapse-item" href="{{route('justificaciones.index')}}">Justificaciones</a>
                        <a class="collapse-item" href="{{route('vacaciones.index')}}">Vacaciones</a>
                    </div>
                </div>    
            </li>
            @endhasanyrole

            @hasanyrole('Admin|Nivel 1|Nivel 2')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reporteProductos" aria-expanded="true" aria-controls="reporteProductos">
                    <i class="fas fa-fw fa-paperclip"></i>
                    <span>Reportes</span>
                </a>
                <div id="reporteProductos" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar" style="">
                    <div class="bg-light py-2 collapse-inner rounded text-white">
                        <a class="collapse-item" href="{{route('events')}}">Eventos</a>
                        <a class="collapse-item" href="{{route('today')}}">Asistencia diaria</a>
                        <a class="collapse-item" href="{{route('month')}}">Asistencia mensual</a>
                        <a class="collapse-item" href="{{route('month2')}}">Reporte mensual</a>
                        <a class="collapse-item" href="{{route('month3')}}">Reporte con horas</a>
                        <a class="collapse-item" href="{{route('noAttendance')}}">Sin Asistencia HOY</a>
                    </div>
                </div>    
            </li>
            @endhasanyrole
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @guest
                        @else
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>
                        @endguest

                        

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                    @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Oficina de Tecnologías de la Información y Comunicaciones - <strong>Municipalidad Provincial de La Convención<strong></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <!--script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.buttons.js')}}"></script>
    <script src="{{asset('vendor/datatables/buttons.bootstrap4.js')}}"></script>
    <script src="{{asset('vendor/datatables/buttons.print.min.js')}}"></script-->

    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="//cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>

    <script src="//cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>



    <!-- App scripts -->
    @stack('scripts')


</body>

</html>