<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ST. SILA DHARMA</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/Asset/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('/Asset/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress CSS -->
    <link href="{{ asset('/Asset/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="{{ asset('/Asset/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom Theme Style -->
    <link href="{{ asset('/Asset/build/css/custom.min.css') }}" rel="stylesheet">
    
    <!-- Additional Styles -->
    <link href="{{ asset('wizard.css') }}" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    
    @stack('styles') <!-- This is for additional styles pushed by specific pages -->
  </head>

  <body class="nav-md">
    @include('sweetalert::alert') <!-- SweetAlert -->

    <div class="container body">
      <div class="main_container">
        <!-- Left Sidebar -->
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><span>ST. SILA DHARMA</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- Profile Section -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <!-- Ensure the image link is correct -->
                <img src="https://i.ibb.co.com/jzD7kYm/logo.png" alt="Logo" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }} ({{ Auth::user()->status }})</h2>
              </div>
              <div class="clearfix"></div>
            </div>

            <br />

            <!-- Sidebar Menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              @include('layouts.sidebar') <!-- Sidebar content -->
            </div>
        </div>
        
        <!-- Top Navigation Bar -->
        <div class="top_nav">
          <div class="nav_menu">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="https://i.ibb.co.com/jzD7kYm/logo.png" alt="Profile">{{ Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="javascript:;">Profile</a>
                    <a class="dropdown-item" href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out pull-right"></i> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>

        <!-- Main Content -->
        <div class="right_col" role="main">
          @yield('content') <!-- Main content section, specific to each page -->
        </div>

        <!-- Footer -->
        @include('layouts.footer')
      </div>
    </div> 
  </body>

  @stack('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- jQuery -->
  <script src="{{ asset('/Asset/vendors/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap JS -->
  <script src="{{ asset('/Asset/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- DataTables JS -->
  <script src="{{ asset('/Asset/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/Asset/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- Custom JS -->
  <script src="{{ asset('/Asset/build/js/custom.min.js') }}"></script>
</html>
