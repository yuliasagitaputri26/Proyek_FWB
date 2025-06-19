@extends('layout.master')

@section('content')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar" style="position: fixed; top: 0; bottom: 0; left: 0; height: 100vh; z-index: 1030;">

    <!-- Sidebar Branding -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard-petugas">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-smile-beam"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HALAMAN <br><small>PETUGAS</small></div>
    </a>

   

    <!-- Petugas Only -->
    @if(Auth::user()->role == 'petugas')
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/layanan-petugas">
                <i class="fas fa-concierge-bell"></i>
                <span>Layanan Petugas</span>
            </a>
        </li>

        <!-- Status Pesanan -->
        <li class="nav-item">
            <a class="nav-link" href="/status-pesanan">
                 <i class="fas fa-clipboard-list"></i>
                <span>Status Pesanan</span>
            </a>
        </li>


<li class="nav-item">
    <a class="nav-link" href="{{ route('petugas.order_service.harga') }}">
       <i class="fas fa-tasks"></i>
        <span>Kelola Pesanan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('petugas.TransaksiPetugas.index') }}">
        <i class="fas fa-receipt"></i>
        <span>Daftar Transaksi</span>
    </a>
</li>


    @endif
<hr class="sidebar-divider d-none d-md-block">
</ul>


        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
                    </div>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        

                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

   <span class="mr-2 d-none d-lg-inline text-info small font-weight-bold">
       {{ Auth::user()->name }}
   </span>

   {{-- FOTO PROFIL --}}
   @if (Auth::user()->profile && Auth::user()->profile->profile_picture)
       <img class="img-profile rounded-circle"
            src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}"
            alt="Foto Profil" width="10" height="10">
   @else
       <img class="img-profile rounded-circle"
            src="{{ asset('default-avatar.png') }}"
            alt="Default Avatar" width="10" height="10">
   @endif

</a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/edit-profil">
                                <i class="fa fa-user me-2"></i> Profile
                                </a>


                               
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                 @csrf
                                <button type="submit">Logout</button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="min-height: 100vh; background: linear-gradient(to right, #2197a6, #acd9e7); font-family: 'Segoe UI', sans-serif;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 90vh; margin-left: 125px; margin-top: -15px; transform: translateX(20px);">
        <div class="card shadow-lg border-0 p-5 text-center" style="border-radius: 25px; max-width: 600px; width: 100%; background: #ffffffee;">
            <div class="card-body">
                <img src="https://www.svgrepo.com/show/327388/cleaning-service.svg" alt="Welcome Illustration"
                    style="width: 120px;" class="mb-4 animate__animated animate__fadeInDown">
                
                <h2 class="text-primary font-weight-bold mb-2 animate__animated animate__fadeInUp">
                    <i class="fas fa-hand-sparkles"></i> Selamat Datang
                </h2>

                <p class="text-muted mb-2 animate__animated animate__fadeInUp animate__delay-1s">
                    di Halaman Petugas Laundry
                </p>
                
                <p class="small text-secondary animate__animated animate__fadeInUp animate__delay-2s">
                    Silakan mulai dengan memilih menu di samping kiri.
                </p>

                <!-- Tombol Navigasi -->
                <div class="mt-4 d-flex justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-3s">
                    <a href="/layanan-petugas" class="btn btn-outline-primary btn-sm rounded-pill px-4">Layanan</a>
                    <a href="/status-pesanan" class="btn btn-outline-success btn-sm rounded-pill px-4">Status</a>
                    <a href="/petugas/harga" class="btn btn-outline-info btn-sm rounded-pill px-4">Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>



                    <!-- Page Heading -->
                    

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                           

                            <!-- Color System -->
                            
                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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
@endsection