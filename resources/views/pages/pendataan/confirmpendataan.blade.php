@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush


@push('scripts')
    @livewireScripts
    <script>
    
        // Mendengarkan event untuk membuka dan menutup modal
        window.livewire.on('openModal', () => {
            $('#iuranModal').modal('show');
        });

        window.livewire.on('closeModal', () => {
            $('#iuranModal').modal('hide');
        });
    </script>

    <script>
        window.livewire.on('openPaymentModal', () => {
            $('#paymentModal').modal('show');
        });

        window.livewire.on('closeModal', () => {
            $('#paymentModal').modal('hide');
        });

        window.addEventListener('paymentProcessed', event => {
                Livewire.emit('showPaymentModal');

            });
        
        window.addEventListener('paymentCancelled', event => {
            // Close the modal after canceling payment
            $('#paymentModal').modal('hide');
            // Or you can re-open the payment modal if needed
            Livewire.emit('showPaymentModal');
        });

        window.addEventListener('focusInput', function () {
            // Fokuskan elemen input dengan ID 'jumlah'
            document.getElementById('jumlah').focus();
        });
    </script>

    <script>
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

        Livewire.on('error', data => {
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
                icon: 'error',
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

        Livewire.on('kasin', data => {
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
                    livewire.emit('kirimkekasinconfirm');
                }
            })
        }); 
    </script>
@endpush



@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>CONFIRM PENDATAAN</h3>
        </div>
    </div>

        <div class="clearfix"></div>

        <!-- MEMANGGIL LIVEWIRE -->
        @livewire('pendataan');
    
    </div>
</div>
         

@endsection