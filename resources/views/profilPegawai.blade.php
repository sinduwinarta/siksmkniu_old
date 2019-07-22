@extends(Session::get('data')->jabatanable_type == "App\Staf" ? 'layouts.staf' : 
        (Session::get('data')->jabatanable_type == "App\Pimpinan" ? 'layouts.pimpinan' : 'layouts.admin'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-user"></i>
    Profile
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          @if(Session::get('data')->foto_pegawai)
          <img src="{{ asset('storage/' . Session::get('data')->foto_pegawai) }}" class="profile-user-img img-responsive img-circle" alt="User Image">
          @else
          <img src="{{ asset('beranda/dist/img/profilepicture.png') }}" class="profile-user-img img-responsive img-circle" alt="User Image">
          @endif

          <h3 class="profile-username text-center">{{Session::get('data')->nama_pegawai}}</h3>

          <p class="text-muted text-center"><b>{{Session::get('data')->email_pegawai}}</b></p>

          <p class="text-muted text-center">{{substr(Session::get('data')->jabatanable_type, 4, 10)}} KNIU</p>
          
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- About Me Box -->
      <div class="box box-primary" style="visibility: hidden;">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">About Me</h3> -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-book margin-r-5"></i> Sektor</strong>

          <p class="text-muted">test</p>

          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> Ruangan</strong>

          <p class="text-muted">test</p>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#settings" data-toggle="tab">Pengaturan Profile</a></li>
          <li><a href="#avatar" data-toggle="tab">Foto</a></li>
        </ul>
        <div class="tab-content">

          <div class="active tab-pane" id="settings">
            <form class="form-horizontal" action="{{ url('profil/update/' . Session::get('data')->id_pegawai) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{method_field('PATCH')}}

              <div class="form-group">
                <label for="nip" class="col-sm-2 control-label">Nomor Induk</label>

                <div class="col-sm-10">
                  <input type="number" name="nip" class="form-control" id="nip" placeholder="Nomor Induk" value="{{Session::get('data')->nip}}">
                </div>
              </div>

              <div class="form-group">
                <label for="nama_pegawai" class="col-sm-2 control-label">Nama</label>

                <div class="col-sm-10">
                  <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai" placeholder="Nama" value="{{Session::get('data')->nama_pegawai}}">
                </div>
              </div>

              <div class="form-group">
                <label for="email_pegawai" class="col-sm-2 control-label">Surel</label>

                <div class="col-sm-10">
                  <input type="email" name="email_pegawai" class="form-control" id="email_pegawai" placeholder="Email" value="{{Session::get('data')->email_pegawai}}">
                </div>
              </div>

              <div class="form-group">
                <label for="no_telp_pegawai" class="col-sm-2 control-label">Nomor Telepon</label>

                <div class="col-sm-10">
                  <input type="number" name="no_telp_pegawai" class="form-control" id="no_telp_pegawai" placeholder="Nomor Handphone" value="{{Session::get('data')->no_telp_pegawai}}">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Ubah Sandi</label>

                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="password" onkeyup='check();'>
                </div>
              </div>

              <div class="form-group">
                <label for="confirm_password" class="col-sm-2 control-label">Ulangi Sandi</label>

                <div class="col-sm-10">
                  <input type="password" name="confirm_password" class="form-control" id="confirm_password" onkeyup='check();'>
                  <span id='message' name="message"></span>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info center-block" name="submit" id="submit" disabled>Submit</button>
                </div>
              </div>

            </form>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="avatar">
            <form class="form-horizontal" action="{{ url('profil/update/avatar/' . Session::get('data')->id_pegawai) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{method_field('PATCH')}}

              <div class="form-group">
                <label for="foto_pegawai" class="col-sm-2 control-label">Foto</label>

                <div class="col-sm-10">
                  <input type="file" value="" name="foto_pegawai" class="form-control" id="foto_pegawai">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info center-block">Kirim</button>
                </div>
              </div>

            </form>
          </div>
          <!-- /.tab-pane -->

        </div>
        <!-- /.tab-content -->
        
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->


</section>
<!-- /.content -->
@endsection
