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
                      <h2>Hallo Selama Datang <b>{{ Auth::user()->name }}</b>, anda memiliki hak akses sebagai <b>{{ Auth::user()->status }}</b></h2>
                  </div>
                </div>
              </div>
            </div>
        
        </div>
@endsection