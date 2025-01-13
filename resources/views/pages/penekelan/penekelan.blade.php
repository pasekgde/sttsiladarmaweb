@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush


@push('scripts')
    @livewireScripts

    <<script>
        window.livewire.on('openPaymentModal', () => {
            $('#paymentModal').modal('show');
        });
        window.livewire.on('closeModal', () => {
            $('#paymentModal').modal('hide');
        });

        window.livewire.on('openHistoryModal', () => {
            $('#historyModal').modal('show');
        });
        window.livewire.on('closeModal', () => {
            $('#historyModal').modal('hide');
        });

        Livewire.on('successpenekelan', data => {
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

        function formatRupiah(angka) {
        var number_string = angka.value.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            remainder = split[0].length % 3,
            rupiah = split[0].substr(0, remainder),
            thousands = split[0].substr(remainder).match(/\d{3}/gi);

        // tambahkan separator ribuan
        if (thousands) {
            separator = remainder ? '.' : '';
            rupiah += separator + thousands.join('.');
        }

        // tambahkan koma setelah angka integer
        rupiah = split[1] ? rupiah + ',' + split[1] : rupiah;
        angka.value = rupiah;
        }
    </script>
@endpush



@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>DATA PENEKELAN</h3>
        </div>
    </div>

        <div class="clearfix"></div>
        @livewire('penekelan')

        <!-- MEMANGGIL LIVEWIRE -->
       
    
    </div>
</div>

@endsection