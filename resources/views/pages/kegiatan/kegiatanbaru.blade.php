@extends('layouts.master')

@push('styles')
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush


@push('scripts')
    @livewireScripts
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('closeModal', () => {
                $('#createKegiatanModal').modal('hide'); // Gunakan jQuery untuk menutup modal
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#tglpembuatan", {
                dateFormat: "d/m/Y", // Format tanggal sesuai kebutuhan
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

        Livewire.on('focuss', data => {
            document.querySelector('#namakegiatan').focus()
        });  

        Livewire.on('hapus', data => {
            Swal.fire({
                title: data.pesan,
                text: data.text,
                icon: data.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('deleteconfirm');
                    Swal.fire({
                    icon: 'success',
                    title: 'Tersimpan',
                    text: 'Aman be ilang',
                    showConfirmButton: false,
                    timer: 1500
                    });
                }
            })
        });

        Livewire.on('kegiatan', data => {
            Swal.fire({
                title: data.pesan,
                text: data.text,
                icon: data.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan ke KASIN'
                }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('kegiatankirimkekasinconfirm');
                }
            })
        }); 

    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{URL::asset('/Asset/vendors/jquery/dist/jquery.min.js')}}"></script>
@endpush



@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>DATA KEGIATAN</h3>
        </div>
    </div>

        <div class="clearfix"></div>

        <!-- MEMANGGIL LIVEWIRE -->
        @livewire('kegiatan')
    
    </div>
</div>

@endsection