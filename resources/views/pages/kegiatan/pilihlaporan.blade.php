@extends('layouts.master')

@push('styles')
    @livewireStyles
    <style>
        .table thead th {
    position: sticky;
    top: 0;
    background-color: #343a40; /* Warna latar belakang untuk header */
    color: white; /* Warna teks untuk header */
    z-index: 1; /* Agar tetap di atas saat scroll */
}
        </style>
@endpush


@push('scripts')
    @livewireScripts
    <script src="{{URL::asset('/Asset/vendors/jquery/dist/jquery.min.js')}}"></script>

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

        Livewire.on('focuss', data => {
            document.querySelector('#tglpembuatan').focus()
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

    </script>
@endpush



@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Pilih laporan Kegiatan</h3>
        </div>
    </div>

        <div class="clearfix"></div>
        <!-- MEMANGGIL LIVEWIRE -->
        @livewire('pilihevent')
    </div>
</div>      
@endsection