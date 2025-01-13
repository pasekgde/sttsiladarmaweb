@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush


@push('scripts')
    @livewireScripts
    <script>
        Livewire.on('success', data => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: data.pesan,
            })
        });
    </script>
@endpush



@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>SISTEM INFO</h3>
        </div>
    </div>

        <div class="clearfix"></div>

        <!-- MEMANGGIL LIVEWIRE -->
        <div class="container body">
            <div class="main_container">
                @livewire('sisteminfo')
            </div>
        </div>
    </div>
</div>            



@endsection