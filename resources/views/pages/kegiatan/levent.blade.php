@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Laporan Kegiatan</h3>
        </div>
    </div>

    <div class="clearfix"></div>  
    @livewire('levent',['postId'=>@intval($ayam)])
</div>

        <script src="{{URL::asset('/Asset/vendors/jquery/dist/jquery.min.js')}}"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


@endsection