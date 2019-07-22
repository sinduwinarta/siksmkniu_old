<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>SIKSM KNIU</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('beranda/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('beranda/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('beranda/bower_components/Ionicons/css/ionicons.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('beranda/dist/css/AdminLTE.min.css') }}">

  <!-- Custom CSS Upload -->
  <link rel="stylesheet" href="{{ asset('beranda/css/upload-file.css')}}" />

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('beranda/dist/css/skins/_all-skins.min.css') }}">

  <!-- Website Theme -->
  <meta id="theme-color" name="theme-color" content="#4AB3B6">
  <link rel="stylesheet" href="{{ asset('beranda/css/dashboard.css') }}" />
  <link rel="stylesheet" href="{{ asset('beranda/css/document-approval.css') }}" />
  <link rel="stylesheet" href="{{ asset('beranda/document-archieved.css') }}" />
  <link rel="stylesheet" href="{{ asset('beranda/recent-activity.css') }}" />
  <link rel="stylesheet" href="{{ ('beranda/profile.css') }}" />
  <link rel="stylesheet" href="{{ ('beranda/document-detail.css') }}" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="icon" type="image/png" href="https://4erff29jo03b8uhp4b94vxhq-wpengine.netdna-ssl.com/wp-content/uploads/2015/05/caspio-features-illustr_cloud-data_3_2x.png"/>
</head>

          <body class="hold-transition skin-blue sidebar-mini">


          <!-- <div class="se-pre-con"></div> -->

          <!-- Section Start -->

          <!-- Site wrapper -->
          <div class="wrapper">

            <!-- Navbar Start -->

            <header class="main-header">

              <!-- Logo -->
              <a href="{{ url('/unggah') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>S</b>K</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SIKSM</b>KNIU</span>
              </a>

              <!-- Header Navbar: style can be found in header.less -->
              <nav class="navbar navbar-static-top">

                <!-- Sidebar toggle button -->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">

                    <!-- TEMPAT NOTIFIKASI -->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- profile picture default & update-->
                        @if(Session::get('data')->foto_pegawai)
                        <img src="{{ asset('storage/' . Session::get('data')->foto_pegawai) }}" class="user-image" alt="User Image">
                        @else
                        <img src="{{ asset('beranda/dist/img/profilepicture.png') }}" class="user-image" alt="User Image">
                        @endif
                        <span class="hidden-xs">{{Session::get('data')->nama_pegawai}}</span>
                      </a>
                      <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                          <!-- profile picture default & update-->
                          @if(Session::get('data')->foto_pegawai)
                          <img src="{{ asset('storage/' . Session::get('data')->foto_pegawai) }}" class="img-circle" alt="User Image">
                          @else
                          <img src="{{ asset('beranda/dist/img/profilepicture.png') }}" class="img-circle" alt="User Image">
                          @endif

                          <p>
                            {{Session::get('data')->nama_pegawai}} - {{substr(Session::get('data')->jabatanable_type, 4, 10)}}
                            <small>Bergabung sejak {{Session::get('data')->created_at->format('d M Y')}}</small>
                          </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                          <div class="pull-left">
                            <a href="{{ url('/profil/edit') }}" class="btn btn-default btn-flat">Profil</a>
                          </div>
                          <div class="pull-right">
                            <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Keluar</a>
                          </div>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </nav>

            </header>

            <!-- Navbar End -->

            <!-- =============================================== -->

            <!-- Main Menu Start -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
              <!-- sidebar: style can be found in sidebar.less -->
              <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                  <div class="pull-left image">
                    <!-- profile picture default & update-->
                    @if(Session::get('data')->foto_pegawai)
                    <img src="{{ asset('storage/' . Session::get('data')->foto_pegawai) }}" class="img-circle" alt="User Image">
                    @else
                    <img src="{{ asset('beranda/dist/img/profilepicture.png') }}" class="img-circle" alt="User Image">
                    @endif
                  </div>
                  <div class="pull-left info">
                    <br>
                    <p>{{Session::get('data')->nama_pegawai}}</p>
                  </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->

                <ul class="sidebar-menu" data-widget="tree">

                  <li class="header">MENU UTAMA</li>

                  <li>
                    <a href="{{ url('/disposisi') }}">
                      <i class="fa fa-folder"></i> <span>Disposisi</span>
                    </a>
                  </li>

                  <li>
                    <a href="{{ url('/arsip') }}">
                      <i class="fa fa-folder"></i> <span>Arsip</span>
                    </a>
                  </li>

                </ul>

              </section>
              <!-- /.sidebar -->
            </aside>

            <!-- Main Menu End -->
            <!-- =============================================== -->

            <!-- Content Start -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              @yield('content')
            </div>
            <!-- /.content-wrapper -->

            <!-- Content End -->

            <!-- =============================================== -->

          </div>

          <!-- ./wrapper -->

          <!-- Section End -->

          <!-- =============================================== -->

          <!-- Script Start -->

          <!--  jQuery -->
          <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

          <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
          <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

          <!-- Bootstrap Date-Picker Plugin -->
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

          <!-- jQuery 3 -->
          <script src="{{ asset('beranda/bower_components/jquery/dist/jquery.min.js') }}"></script>

          <!-- Bootstrap 3.3.7 -->
          <script src="{{ asset('beranda/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

          <!-- daterange picker -->
          <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  
          <!-- bootstrap datepicker -->
          <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  
          <!-- Bootstrap time Picker -->
          <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
  
          <!-- SlimScroll -->
          <script src="{{ asset('beranda/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

          <!-- FastClick -->
          <script src="{{ asset('beranda/bower_components/fastclick/lib/fastclick.js') }}"></script>

          <!-- DataTables -->
          <script src="{{ asset('beranda/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
          <script src="{{ asset('beranda/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

          <!-- AdminLTE App -->
          <script src="{{ asset('beranda/dist/js/adminlte.min.js') }}"></script>

          <script>
            $(document).ready(function () {
              $('.sidebar-menu').tree()
            })
          </script>

          <!-- JQuery -->
          <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script> -->
          <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

          <!-- ChartJS -->
          <script src="{{ asset('beranda/bower_components/chart.js/Chart.js') }}"></script>

          <!-- Chart Javascript Graphic Animation-->
          <script src="{{ asset('beranda/dist/js/pages/dashboard2.js') }}"></script>

          <!-- Loading Screen Animation -->

          <script>
              $(window).load(function() {
                  $(".se-pre-con").fadeOut("slow");;
              });
          </script>

          <!-- page script Document-approval-->
          <script>
            $(function () {
              $('#example1').DataTable()
              $('#example2').DataTable()
              $('#example3').DataTable()
              $('#example4').DataTable()
            })
          </script>

          <script src="{{ asset('beranda/upload-file.js') }}"></script>

          <script type='text/javascript'>
                var check = function() {
                  if (document.getElementById('password').value ==
                    document.getElementById('confirm_password').value) {
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = 'matching';
                    document.getElementById('submit').disabled = false;
                  } else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = 'not matching';
                    document.getElementById('submit').disabled = true;
                  }
                }
            </script>
            <script type="text/javascript">
              $(document).on("click", ".open-HapusModal", function () { //target tombol modalnya
                   var id_surat = $(this).data('id'); //masukin id surat di data-id ke variable id_surat
                   $(".modal-footer #id_surat").val( id_surat );  //msk var tadi ke input hidden di dalam class modal-footer dgn id id_surat
                   // As pointed out in comments, 
                   // it is unnecessary to have to manually call the modal.
                   // $('#addBookDialog').modal('show');
              });
            </script>
            <script type="text/javascript">
              $(document).on("click", ".open-Disposisi", function () { //target tombol modalnya
                   var id_disposisi = $(this).data('id'); //masukin id surat di data-id ke variable id_surat
                   $(".modal-footer #id_surat").val( id_disposisi );  //msk var tadi ke input hidden di dalam class modal-footer dgn id id_surat
                   // As pointed out in comments, 
                   // it is unnecessary to have to manually call the modal.
                   // $('#addBookDialog').modal('show');
              });
            </script>
            <!-- alert box -->
            <script>
              var msg = '{{Session::get('alert')}}';
              var exist = '{{Session::has('alert')}}';
              if(exist){
                alert(msg);
              }
            </script>
          <!-- Script End -->

        </body>
        </html>
