@extends('layouts.pimpinan')

@section('content')

<!-- Main content -->
<section class="content">

  <!-- Navigation Tab Start -->

  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="#unggah" data-toggle="tab">Unggahan</a></li>
        <li class="active"><a href="#tinjau" data-toggle="tab">Perlu Tinjauan</a></li>
      </ul>
      <div class="tab-content">

        <!-- Baru diunggah Tab Start -->

        <div class="tab-pane" id="unggah">

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Surat Baru</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table no-margin" style="white-space: nowrap;">
                  <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Pengirim</th>
                    <th>Tujuan</th>
                    <th>Perihal</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Unggah</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if($jumlahsuratbaru !== 0)
                    @foreach($surats as $surat)
                      @if($surat->status_surat == 'baru')
                        <tr>
                          <td>{{$surat->no_surat}}</td>
                          <td>{{$surat->instansi->nama_instansi}}</td>
                          <td>{{$surat->sektor->nama_sektor}}</td>
                          <td>{{$surat->perihal_surat}}</td>
                          <td>{{date('d M Y', strtotime($surat->tanggal_surat))}}</td>
                          <td>{{$surat->created_at->format('d M Y')}}</td>
                          <td>

                            <!-- proses surat untuk di tinjau pimpinan -->
                            <a href="{{ url('/surat/proses/' . $surat->id_surat) }}">
                            <button type="button" class="btn btn-sm btn-primary btn-flat">Proses</button>
                            </a>

                            <!-- melihat detail surat -->
                            <a href="{{ url('/surat/detail/' . $surat->id_surat) }}">
                            <button type="button" class="btn btn-sm btn-warning btn-flat">Rincian</button>
                            </a>
                            
                            <button type="button" class="open-HapusModal btn btn-sm btn-danger btn-flat" data-toggle="modal" data-target="#modal-danger" data-id="{{ $surat->id_surat }}">Hapus</button>

                          </td>
                        </tr>
                      @endif
                    @endforeach
                  @else
                    <tr><td>Tidak ada surat masuk</td></tr>
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

        <!-- Baru diunggah Tab End -->

        <!-- Tinjau Tab Start -->

        <div class="active tab-pane" id="tinjau">

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Perlu Tinjauan</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="table-responsive">
                <table id="example2" class="table no-margin">
                  <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Pengirim</th>
                    <th>Tujuan</th>
                    <th>Perihal</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Unggah</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if($jumlahsurattinjau !== 0)
                      @foreach($surats as $surat)
                        @if($surat->status_surat == 'tinjau')
                          <tr>
                            <td>{{$surat->no_surat}}</td>
                            <td>{{$surat->instansi->nama_instansi}}</td>
                            <td>{{$surat->sektor->nama_sektor}}</td>
                            <td>{{$surat->perihal_surat}}</td>
                            <td>{{date('d M Y', strtotime($surat->tanggal_surat))}}</td>
                            <td>{{$surat->created_at->format('d M Y')}}</td>
                            <td>
                                <a data-target="#modal-default" data-toggle="modal" data-userid="<?php echo $surat->id_surat; ?>">
                                  <button type="button" class="btn btn-sm btn-primary btn-flat">Disposisi</button>
                                </a>

                                <a href="{{ url('/arsip/baru/' . $surat->id_surat) }}">
                                  <button type="button" class="btn btn-sm btn-success btn-flat">Arsip</button>
                                </a>

                                <a href="{{ url('/surat/detail/' . $surat->id_surat) }}">
                                  <button type="button" class="btn btn-sm btn-warning btn-flat">Rincian</button>
                                </a>
                                
                                <a href="{{ url('/surat/cancel/' . $surat->id_surat) }}">
                                  <button type="button" class="btn btn-sm btn-danger btn-flat">Batal</button>
                                </a>
                            </td>
                          </tr>
                        @endif
                      @endforeach
                    @else
                      <tr><td>Tidak ada surat masuk</td></tr>
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

        <!-- Tinjau Tab End -->

      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>

  <!-- Navigation Tab End -->

<!-- Modal Start -->
<form action="{{ url('/disposisi/baru/') }}" method="POST" enctype="multipart/form-data" >
{{ csrf_field() }}
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lembar Disposisi</h4>
              </div>
              <div class="modal-body">
                
                <!-- tujuan disposisi -->
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="pull-right">Disposisi Kepada :</label>
                    </div>                                      
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select name="nama_pegawai" class="form-control">
                        @foreach($pegawais as $pegawai)
                          <option value="{{ $pegawai->nama_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
                        @endforeach
                      </select>
                    </div>                                      
                  </div>
                </div>
              <!-- pesan disposisi -->
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="pull-right">Pesan Disposisi :</label>
                      <input style="display: none;" name="id_surat" value="">
                    </div>                                      
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <textarea placeholder=" Masukkan pesan disposisi. " rows="4" cols="50" name="pesan_disposisi"></textarea>
                    </div>                   
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kirim Disposisi</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</form>
  <!-- Modal End -->

  <!-- Modal Hapus Surat Start -->
<form action="{{ url('/surat/destroy/') }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b>Hapus</b> Surat</h4>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin akan <b>Menghapus Permanen</b> Surat ini ?</p>
          <small>Surat yang sudah dihapus <b>TIDAK DAPAT</b> dikembalikan.</small>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline">Ya</button>
          <button type="button" class="btn btn-outline" data-dismiss="modal">Tidak</button>
          <input type="hidden" name="id_surat" id="id_surat" value=""/>
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
