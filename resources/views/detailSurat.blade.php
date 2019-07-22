@extends(Session::get('data')->jabatanable_type == "App\Staf" ? 'layouts.staf' : 
        (Session::get('data')->jabatanable_type == "App\Pimpinan" ? 'layouts.pimpinan' : 'layouts.admin'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>

<section class="invoice">

    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-file-text"></i> Gambar
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <div class="container">
      <div class="row" style="margin-left: -190px; margin-top: -40px; width: 1000px; float: left; overflow-x:scroll; white-space: nowrap; display: flex">
        @foreach($images as $image)
          <div style="margin-left: 10px">
            <embed src="{{ asset('storage/' . $image->image) }}" type="application/pdf" height="700px" width="500px">
          </div>
        @endforeach
      </div>
    </div>
</section>

<!-- Main content -->
<section class="invoice">

  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-file-text"></i> {{$surat->perihal_surat}}
        <small class="pull-right">Tanggal Unggah : {{$surat->created_at->format('d-m-Y') }}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>

  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-3 invoice-col">
      Pengirim Surat
      <br>
      <address>
        <strong>{{$surat->instansi->nama_instansi}}</strong><br>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-3 invoice-col">
      Tujuan Sektor
      <br>
      <address>
        <strong>{{$surat->sektor->nama_sektor}}</strong><br>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-3 invoice-col">
      Rincian Surat
      <br>
      <address>
        <strong>Nomor Surat :</strong> {{$surat->no_surat}}<br>
        <strong>Tanggal Surat :</strong> {{$surat->tanggal_surat}}<br>
        @foreach($pegawai as $p)
        <strong>Pengunggah :</strong> {{$p->nama_pegawai}}<br>
        @endforeach      
      </address>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <hr>
  <!-- Download & Download Button -->
  <div class="row no-print">
    <div class="col-xs-12">
      <div class="btn-toolbar">
        <!-- user yang unggah -->
        @if($id_current_user == $surat->id_admin)
        <a href="{{ url('surat/edit/' . $surat->id_surat) }}" class="btn btn-warning pull-left"><i class="fa fa-edit"></i> Ubah</a>
        @else
        <a class="btn btn-dark pull-left" disabled="disabled"><i class="fa fa-edit"></i> Ubah</a>
        @endif

        <!-- tombol download -->
        <a href="{{ url('surat/download/' . $surat->id_surat) }}" target="_blank" class="btn btn-warning"><i class="fa fa-download"></i> Unduh</a>

        <!-- tombol kembali -->
        <a href="{{ url('/surat') }}" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
@endsection
