@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush


@push('scripts')
    @livewireScripts
    <script>
        Livewire.on('showModal', (anggota) => {
            $('#modalViewAbsensi').modal('show');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Menangani klik tombol Bayar
            document.querySelectorAll('#bayarButton').forEach(function (button) {
                button.addEventListener('click', function () {
                    const idAnggota = this.getAttribute('data-idanggota'); // Ambil ID anggota yang diklik

                    // Menampilkan konfirmasi SweetAlert
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Proses pembayaran ini akan mengubah status menjadi lunas!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, bayar!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika klik 'Yes', jalankan aksi pembayaran
                            Livewire.emit('bayar', idAnggota); // Mengirim event ke Livewire
                        }
                    });
                });
            });
        });
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
    </script>
    <script>
        function formatRupiah(input) {
            // Hapus karakter non-digit kecuali koma
            let value = input.value.replace(/[^,\d]/g, '');
            let [integer, decimal] = value.split(',');

            // Format angka dengan titik setiap ribuan
            let result = integer.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            if (decimal !== undefined) {
                result += ',' + decimal;
            }

            // Tambahkan prefix 'Rp ' dan tampilkan hasilnya
            input.value = 'Rp ' + result;
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#datepicker", {
            dateFormat: "d/m/Y", // Format yang akan ditampilkan
            onChange: function(selectedDates, dateStr, instance) {
                // Format tanggal untuk disimpan (mengubahnya menjadi Y-m-d)
                var formattedDate = flatpickr.formatDate(selectedDates[0], "Y-m-d");
                document.getElementById('datepicker').value = formattedDate;
                document.getElementById('datepicker').dispatchEvent(new Event('input')); // Trigger input event
            }
        });
    });
</script>

    
    <script src="{{URL::asset('/Asset/vendors/jquery/dist/jquery.min.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endpush



@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>DATA KEGIATAN</h3>
        </div>
    </div>

    <div class="clearfix"></div>
        @livewire('denda')
    </div>
</div>

@endsection

    

