@extends('layouts.superadmin')

@section('content')
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">

  <!-- Navigation Tab Start -->

  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#pegawai" data-toggle="tab">Daftar Pegawai</a></li>
      </ul>
      <div class="tab-content">


        <!-- EDIT HERE !!! -->

        <!-- Pegawai Tab Start -->

        <div class="active tab-pane" id="pegawai">

          <div class="box box-info">
            <!-- /.box-header -->

            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table no-margin">
                  <thead>
                  <tr>
                    <th>Nama Pegawai</th>
                    <th>NIP</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Promote/Demote</th>
                    <th>Hapus</th>
                  </tr>
                  </thead>
                  <tbody>
                  <!-- kondisi jika tidak ada user di database -->
                  @if($dataPegawai !== 0)
                    <!-- foreach untuk memanggil seluruh surat yang ada di database dan looping -->
                    @foreach($dataPegawai as $pegawai)
                        <tr>
                          <td>{{$pegawai->nama_pegawai}}</td>
                          <td>{{$pegawai->nip}}</td>
                          <td>{{$pegawai->no_telp_pegawai}}</td>
                          <td>{{$pegawai->email_pegawai}}</td>
                          @if($pegawai->jabatanable_type == 'App\Admin')
                          <td>Admin</td>
                          @elseif($pegawai->jabatanable_type == 'App\Pimpinan')
                          <td>Pimpinan</td>
                          @else
                          <td>Staf</td>
                          @endif
                          <td>
                              <!-- check admin -->
                              @if($pegawai->jabatanable_type == 'App\Admin')
                              <button disabled type="button" class="btn btn-sm btn-primary btn-flat">Admin</button>
                              @else
                              <a href="{{ url('/superadmin_dataPegawai/setadmin/' . $pegawai->id_pegawai) }}">
                              <button type="button" class="btn btn-sm btn-primary btn-flat">Admin</button>
                              </a>
                              @endif

                              <!-- check pimpinan -->
                              @if($pegawai->jabatanable_type == 'App\Pimpinan')
                              <button disabled type="button" class="btn btn-sm btn-primary btn-flat">Pimpinan</button>
                              @else
                              <a href="{{ url('/superadmin_dataPegawai/setpimpinan/' . $pegawai->id_pegawai) }}">
                              <button type="button" class="btn btn-sm btn-primary btn-flat">Pimpinan</button>
                              </a>
                              @endif

                              <!-- check staf -->
                              @if($pegawai->jabatanable_type == 'App\Staf')
                              <button disabled type="button" class="btn btn-sm btn-primary btn-flat">Staf</button>
                              @else
                              <a href="{{ url('/superadmin_dataPegawai/setstaf/' . $pegawai->id_pegawai) }}">
                              <button type="button" class="btn btn-sm btn-primary btn-flat">Staf</button>
                              </a>
                              @endif
                          </td>
                            <td>
                              <!-- hapus user -->
                              <form action="{{ url('/superadmin_dataPegawai/delete/' . $pegawai->id_pegawai) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                  <button type="submit" class="btn btn-sm btn-danger btn-flat">Hapus</button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                  @else
                    <tr><td>Tidak ada pegawai</td></tr>
                  @endif
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>

          <!-- TABLE : Document End -->

        </div>
        <!-- /.tab-pane -->

        <!-- Pegawai Tab End -->

        <!-- EDIT DONE HERE!!!! -->

      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>

  <!-- Navigation Tab End -->

</section>
<!-- /.content -->
@endsection
