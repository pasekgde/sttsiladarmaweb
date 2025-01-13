@extends('layouts.master')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
        <h3>Tambah Data Anggota</h3>
        </div>
    </div>

        <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Master/Tambah Data Anggota</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  

                        <form method="POST" action="/updatedatanggota/{{$datas->idanggota}}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @method('PUT')
                        {{ csrf_field() }}
                        
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Anggota <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" required="required" class="form-control @error('nama', 'post') is-invalid @enderror text-uppercase" name="nama" value="{{$datas->nama}}" autofocus/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="tgl" data-provide="datepicker"  class="form-control datepicker @error('tgllahir', 'post') is-invalid @enderror" name="tgllahir" value="{{$datas->tgllahir}}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Umur <span class="required">*</span>
                                </label>
                                <div class="col-md-1 col-sm-1 ">
                                    <input type="int" id="umur" class="form-control @error('umur', 'post') is-invalid @enderror" name="umur" value="{{$datas->umur}}" readonly>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Pekerjaan <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control @error('pekerjaan', 'post') is-invalid @enderror" name="pekerjaan" value="{{$datas->pekerjaan}}" required="required">
                                        @if($datas->pekerjaan)
                                        <option value="{{$datas->pekerjaan}}" selected>{{$datas->pekerjaan}}</option>
                                        <option>SMP</option>
                                        <option>SMA/SMK</option>
                                        <option>Mahasiswa</option>
                                        <option>Bekerja</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Tempek <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="radio" name="tempek" id="Kangin" value="Kangin" {{ $datas->tempek == 'Kangin' ? 'checked' : ''}}> Kangin <br>
								    <input type="radio" name="tempek" id="Kauh" value="Kauh" {{ $datas->tempek == 'Kauh' ? 'checked' : ''}}> Kauh
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control @error('status', 'post') is-invalid @enderror" name="status" value="{{$datas->status}}" required="required">
                                        @if($datas->status)
                                        <option value="{{$datas->status}}" selected>{{$datas->status}}</option>
                                        <option>Aktif</option>
                                        <option>Nekel</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a href="dataanggota" class="btn btn-success" type="button">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Ubah</button>
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
                format: 'yyyy/mm/dd',
                autoclose: true,
                todayHighlight: true
            });

$(".datepicker").change(function(){
    var dob = new Date(this.value);
    var today = new Date();
    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
    $('#umur').val(age);
});
        
  </script>
@endsection