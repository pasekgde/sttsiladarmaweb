@extends('layouts.master')
@section('content')
<style>
        .card-custom {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .card-title {
            font-size: 1.0rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .card-text {
            font-size: 1.7rem;
            font-weight: 700;
        }

        .cardss-text {
            font-size: 1.0rem;
            font-weight: 700;
        }

        .bg-primary-custom {
            background: linear-gradient(135deg, #6f42c1, #007bff);
        }

        .bg-success-custom {
            background: linear-gradient(135deg, #28a745, #218838);
        }

        .bg-warning-custom {
            background: linear-gradient(135deg, #ffc107, #e0a800);
        }

        .bg-danger-custom {
            background: linear-gradient(135deg, #ff0000, #ed2939);
        }

    </style>

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

                @livewire('dashboard')

                
                    
              </div>
            </div>
        
        </div>
@endsection