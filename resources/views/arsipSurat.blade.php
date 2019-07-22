@extends(Session::get('data')->jabatanable_type == "App\Staf" ? 'layouts.staf' : 
        (Session::get('data')->jabatanable_type == "App\Pimpinan" ? 'layouts.pimpinan' : 'layouts.admin'))

@section('content')

<!-- Main content -->
<section class="content">

  <!-- Navigation Tab Start -->

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Arsip</h3>

          <div class="box-tools pull-right">
          </div>
        </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table no-margin">
                  <thead>
                  <tr>
                    <th>No. Surat</th>
                    <th>Perihal Surat</th>
                    <th>Instansi</th>
                    <th>Sektor</th>
                    <th>Tanggal Unggah</th>
                    <th>Tanggal Arsip</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if($jumlaharsip !== 0)
                      @foreach($arsips as $arsip)
                          <tr>
                            <td>{{$arsip->surat->no_surat}}</td>
                            <td>{{str_limit($arsip->surat->perihal_surat, 15, '...')}}</td>
                            <td>{{$arsip->surat->instansi->nama_instansi}}</td>
                            <td>{{$arsip->surat->sektor->nama_sektor}}</td>
                            <td>{{$arsip->surat->created_at->format('d M Y')}}</td>
                            <td>{{$arsip->created_at->format('d M Y')}}</td>
                            <td>
                            	
                            <!-- detail surat -->
                            <a href="{{ url('/arsip/detail/' . $arsip->id_arsip) }}">
                            <button type="button" class="btn btn-sm btn-warning btn-flat">Detail</button>
                            </a>

                            <!-- hapus arsip -->
                            @if(Session::get('data')->jabatanable_type == "App\Pimpinan")
                            <button type="button" class="open-HapusModal btn btn-sm btn-danger btn-flat" data-toggle="modal" data-target="#modal-danger" data-id="{{ $arsip->id_arsip }}">Hapus</button>
                            @else
                            <button type="button" class="open-HapusModal btn btn-sm btn-danger btn-flat" disabled>Hapus</button>
                            @endif

                            </td>
                      @endforeach
                    @else
                      <tr><td>Tidak ada arsip.</td></tr>
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

        <!-- Disposisi Tab End -->

      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>

  <!-- Modal Hapus Arsip Start -->
<form action="{{ url('/arsip/destroy/') }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b>Hapus</b> Arsip</h4>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin akan <b>Menghapus Permanen</b> Arsip ini ?</p>
          <small>Arsip yang dihapus akan kembali pada tabel tinjauan.</small>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline">Ya</button>
          <button type="button" class="btn btn-outline" data-dismiss="modal">Tidak</button>
          <input type="hidden" name="id_arsip" id="id_arsip" value=""/>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</form>
  <!-- Modal End -->

</section>
<!-- /.content -->
@endsection
