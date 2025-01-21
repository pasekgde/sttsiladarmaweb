@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush


@push('scripts')
    @livewireScripts
    <script>
        Livewire.on('yakinsetuju', data => {
            Swal.fire({
                title: data.pesan,
                text: data.text,
                icon: data.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Setujui'
                }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('setujuconfirm');
                    Swal.fire({
                    icon: 'success',
                    title: 'Tersimpan',
                    text: 'Data Tersimpan',
                    showConfirmButton: false,
                    timer: 1500
                    });
                }
            })
        });

        Livewire.on('hapus', data => {
            Swal.fire({
                title: data.pesan,
                text: data.text,
                icon: data.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Setujui'
                }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('yakindestoyconfirm');
                    Swal.fire({
                    icon: 'success',
                    title: 'Terhapus',
                    text: 'Data Terhapus',
                    showConfirmButton: false,
                    timer: 1500
                    });
                }
            })
        }); 

        Livewire.on('berhasil', data => {
                    Swal.fire({
                    icon: 'success',
                    title: 'Dibuat',
                    text: 'Pengajuan Dibuat',
                    showConfirmButton: false,
                    timer: 1500
                    });
        }); 

      

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
            <h3>DATA KELUAR ANGGOTA STT</h3>
        </div>
    </div>

        <div class="clearfix"></div>

        <!-- MEMANGGIL LIVEWIRE -->
        <div class="container body">
            <div class="main_container">
              @livewire('outstt')
            </div>
        </div>
    </div>
</div>            



@endsection