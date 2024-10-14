@extends('layouts.master')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
        <h3>Tambah Data KAS</h3>
        </div>
    </div>

        <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data KAS/Tambah Data Kas Masuk</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  

                        <form method="POST" action="" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Kode Kas <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" required="required" class="form-control" name="kodekas" disabled>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis KAS <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" required="required" class="form-control" name="jeniskas" value="Masuk" disabled>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal KAS<span class="required">*</span>
                                </label>
                                <div class="col-md-3 col-sm-3 ">
                                    <input type="text" id="tgl" data-provide="datepicker"  class="form-control datepicker @error('tglkas', 'post') is-invalid @enderror" name="tglkas" value="<?php $tgl = date('d/m/Y'); echo $tgl; ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea class="form-control @error('keterangan', 'post') is-invalid @enderror" name="keterangan"></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">QTY <span class="required">*</span>
                                </label>
                                <div class="col-md-1 col-sm-1 ">
                                    <input type="number" class="form-control @error('qty', 'post') is-invalid @enderror" onkeyup="kali2()" name="qty" id="qty">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Harga <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="number" class="form-control @error('harga', 'post') is-invalid @enderror" onkeyup="kali()" name="harga" id="harga">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Jumlah <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="number" class="form-control @error('jumlah', 'post') is-invalid @enderror" name="jumlah" id="jumlah">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a href="dataanggota" class="btn btn-success" type="button">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>    


                  </div>
                </div>
              </div>
            </div>
        
        </div>
        
        <script src="{{URL::asset('/Asset/vendors/jquery/dist/jquery.min.js')}}"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">

$('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            });

$(".datepicker").change(function(){
    var dob = new Date(this.value);
    var today = new Date();
    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
    $('#umur').val(age);
});

function formatAngka(angka) {
      if (typeof(angka) != 'string') angka = angka.toString();
      var reg = new RegExp('([0-9]+)([0-9]{3})');
      while(reg.test(angka)) angka = angka.replace(reg, '$1,$2');
      return angka;
    }

    function kali() {
      var txtFirstNumberValue = document.getElementById('harga').value;
      var txtSecondNumberValue = document.getElementById('qty').value;
      var tes1 = txtFirstNumberValue.replace(",", "");
      document.getElementById('harga').value = formatAngka(tes1);
      var result = parseInt(tes1) * txtSecondNumberValue;
      console.log(txtFirstNumberValue);
      if (txtFirstNumberValue==""){
        document.getElementById('jumlah').value = '';
        
      }else if (result<0) {
        
        document.getElementById('jumlah').value =formatAngka(result);
      }else if (!isNaN(result)) {
           document.getElementById('jumlah').value =formatAngka(result);
           
      }
    }

    function kali2() {
      var txtFirstNumberValue = document.getElementById('harga').value;
      var txtSecondNumberValue = document.getElementById('qty').value;
      var tes1 = txtFirstNumberValue.replace(",", "");
      document.getElementById('harga').value = formatAngka(tes1);
      var result = parseInt(tes1) * txtSecondNumberValue;
      console.log(txtFirstNumberValue);
      if (txtFirstNumberValue==""){
        document.getElementById('jumlah').value = '';
        
      }else if (result<0) {
        
        document.getElementById('jumlah').value =formatAngka(result);
      }else if (!isNaN(result)) {
           document.getElementById('jumlah').value =formatAngka(result);
           
      }
    }




// $("#harga").keyup(function(){
//      var qty = document.getElementById("qty").value;
//      var harga = document.getElementById("harga").value ;
//      var jumlah = document.getElementById("jumlah").value ;

//      jumlah = qty * harga;
//      document.getElementById("jumlah").value = jumlah;
//    });

// $("#qty").keyup(function(){
//     var qty = document.getElementById("qty").value;
//     var harga = document.getElementById("harga").value ;
//     var jumlah = document.getElementById("jumlah").value ;

//     jumlah = qty * harga;
//     document.getElementById("jumlah").value = jumlah;
// });
        
  </script>
@endsection