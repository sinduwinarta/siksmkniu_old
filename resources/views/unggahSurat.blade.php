@extends('layouts.admin')

@section('content')

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Unggah Surat</h3>

          <div class="box-tools pull-right">
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body graphic">
          <div class="row">
            <div class="col-md-12">

              <form action="{{ url('/unggah/baru') }}" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="container">
                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                    <div class="dropzone-wrapper">
                      <div class="dropzone-desc">
                      <i class="glyphicon glyphicon-download-alt"></i>
                      <p>Pilih berkas PDF atau seret berkas ke sini.</p>
                      </div>
                      <input id="uploadPDF" type="file" name="image" class="dropzone">
                    </div>

                    <div class="preview-zone hidden">
                      <div class="box box-solid">
                      <div class="with-border">
                        <h2>Pratinjau Berkas</h2>
                      </div>

                      <!-- PDF Preview Start -->

                      <input class="btn btn-primary center-block" name="image" type="button" value="Preview" onclick="PreviewImage();">
                      <br>

                      <div style="clear:both">
                        <iframe target="_blank" id="viewer" frameborder="0" scrolling="no" width="100%" height="500"></iframe>
                      </div>

                      <!-- PDF Preview End -->

                      <div class="box-body"></div>
                      </div>

                      <!-- Document Description Form Start -->

                      <h3>Form Deskripsi Surat</h3>
                      <br>

                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="pull-right">No. Surat :</label>
                          </div>                                      
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" name="no_surat" class="form-control">
                          </div>                                      
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                              <label class="pull-right">Pengirim Surat :</label>
                            </div>                     
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                  <input type="text" list="instansis" name="pengirim_surat" class="form-control" placeholder="Masukkan nama instansi" />
                                  <datalist id="instansis">
                                    @foreach($instansis as $instansi)
                                    <option>{{ $instansi->nama_instansi }}</option>
                                    @endforeach
                                  </datalist>
                            </div>                     
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                              <label class="pull-right">Tujuan Sektor :</label>
                            </div>                                    
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                  <input type="text" list="sektors" name="tujuan_surat" class="form-control" placeholder="Masukkan nama sektor" />
                                  <datalist id="sektors">
                                    @foreach($sektors as $sektor)
                                    <option>{{ $sektor->nama_sektor }}</option>
                                    @endforeach
                                  </datalist>
                            </div>                                
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="pull-right">Perihal Surat :</label>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <input type="text" name="perihal_surat" class="form-control">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="pull-right">Tanggal Surat :</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <input type="date" name="tanggal_surat" class="form-control" placeholder="dd/mm/yyyy">
                          </div>
                        </div>
                      </div>

                      <!-- Document Description Form End -->

                    </div>

                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary center-block">Unggah</button>
                  </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
          autoclose: true
        })
})
</script>

</section>
<!-- /.content -->
@endsection
<!-- /.sidebar -->
