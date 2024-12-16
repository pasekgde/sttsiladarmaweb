@extends('layouts.master')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
        <h3>DASHBOARD</h3>
        </div>
    </div>

        <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DAHBOARD</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  

                        <form method="POST" action="{{ route('adddatauser') }}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama-user">Nama User <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="nama-user" required="required" class="form-control @error('name', 'post') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="email" required="required" class="form-control @error('email', 'post') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="password" id="password" required="required" class="form-control @error('password', 'post') is-invalid @enderror" name="password" value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control @error('status', 'post') is-invalid @enderror" name="status" value="{{ old('status') }}" required="required">
                                        <option>Superadmin</option>
                                        <option>Ketua</option>
                                        <option>Pengurus</option>
                                        <option>Panitia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                            </div>
                        </form>    


                  </div>
                </div>
              </div>
            </div>
        
        </div>
@endsection