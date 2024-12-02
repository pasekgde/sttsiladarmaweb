@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts 
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
                document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
                element.addEventListener('keyup', function(e) {
                let cursorPostion = this.selectionStart;
                    let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                    let originalLenght = this.value.length;
                    if (isNaN(value)) {
                    this.value = "";
                    } else {    
                    this.value = value.toLocaleString('id-ID', {
                        currency: 'IDR',
                        style: 'currency',
                        minimumFractionDigits: 0
                    });                
                    cursorPostion = this.value.length - originalLenght + cursorPostion;
                    this.setSelectionRange(cursorPostion, cursorPostion);
                    }
                });
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
            document.querySelector('#keterangan').focus()
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
            <h3>DATA KAS</h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <!-- MEMANGGIL LIVEWIRE -->
        <livewire:kasin />     
</div>

        <script src="{{URL::asset('/Asset/vendors/jquery/dist/jquery.min.js')}}"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


@endsection