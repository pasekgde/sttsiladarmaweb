<div>
    <style>
        .loading-container {
            position: fixed;  /* Membuat posisi tetap di layar */
            top: 0;
            left: 0;
            width: 100%;  /* Mengambil lebar seluruh layar */
            height: 100%;  /* Mengambil tinggi seluruh layar */
            display: flex;  /* Menggunakan flexbox */
            justify-content: center;  /* Menempatkan spinner secara horizontal di tengah */
            align-items: center;  /* Menempatkan spinner secara vertikal di tengah */
            background-color: rgba(0, 0, 0, 0.5);  /* Memberikan latar belakang transparan */
            z-index: 9999;  /* Memastikan spinner muncul di atas elemen lainnya */
            flex-direction: column;  /* Menyusun spinner dan teks secara vertikal */
        }

        /* Styling untuk teks loading */
        .loading-text {
            color: white;  /* Warna teks putih */
            font-size: 18px;  /* Ukuran teks */
            margin-top: 10px;  /* Memberikan jarak antara spinner dan teks */
            font-weight: bold;  /* Menebalkan teks */
        }
        </style>

        

    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>DATA ABSENSI</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="card">
                            <h5 class="card-header text-white bg-success text-center">DATA KEGIATAN PRESENSI</h5>
                            <div class="card-body">
                                <div style="max-height: 700px; overflow-y: auto; display: block;">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-fixed">
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle;">#</th>
                                                <th style="text-align: center; vertical-align: middle;">Tanggal Kegiatan</th>
                                                <th style="text-align: center; vertical-align: middle;">Nama Kegiatan</th>
                                                <th style="text-align: center; vertical-align: middle;">Jenis Kegiatan</th>
                                                <th style="text-align: center; vertical-align: middle;">Denda</th>
                                                <th style="text-align: center; vertical-align: middle;">T. Denda</th>
                                                <th style="text-align: center; vertical-align: middle;">T. Anggota</th>
                                                <th style="text-align: center; vertical-align: middle;">T. Hadir</th>
                                                <th style="text-align: center; vertical-align: middle;">T. TK</th>
                                                <th style="text-align: center; vertical-align: middle; background-color: #ffebee; color: #333;">Belum Bayar</th>
                                                <th style="text-align: center; vertical-align: middle; background-color: #abe6a1; color: #d32f2f;">Status</th>
                                                <th style="text-align: center; vertical-align: middle;">Operator</th>
                                                <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($tabelkegiatan as $index => $ev)
                                                <tr>
                                                    <th style="width:2%">{{ $index + 1 }}</th>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->tanggal_kegiatan }}</td>
                                                    <td style="vertical-align: middle;">{{ $ev->nama_kegiatan }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->jenis_kegiatan }}</td>
                                                    <td style="vertical-align: middle;">{{ currency_IDR($ev->denda) }}</td>
                                                    <td style="vertical-align: middle;">{{ currency_IDR($ev->total_denda) }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->total_anggota }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->total_hadir }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->total_tidak_hadir }}</td>
                                                    <td style="text-align: center; vertical-align: middle; background-color: #ffebee; color: #333;">
                                                    @if( $belumBayarCounts[$ev->idkegiatan] ?? 0  != 0)
                                                        <span class="text-danger">{{ $belumBayarCounts[$ev->idkegiatan] ?? 0 }}</span>
                                                    @else
                                                        -
                                                    @endif
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle; background-color: #abe6a1; color: #d32f2f;">
                                                        @if($belumBayarCounts[$ev->idkegiatan] ?? 0 != 0)
                                                            <i class="fa fa-times-circle text-danger"></i> <span class="text-danger">Not Complate</span>
                                                        @else
                                                        <i class="fa fa-check-circle text-success"></i> <span class="text-success">Complate</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->user }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                    <button 
                                                        class="btn btn-sm btn-outline-success" 
                                                        wire:click="$set('selectedKegiatanId', {{ $ev->idkegiatan }})">
                                                        <i class="fa fa-eye"></i> View
                                                    </button>

                                                    <!-- Button Delete -->
                                                    <button 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        wire:click="destroydenda({{ $ev->idkegiatan }})">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                    <button 
                                                        class="btn btn-sm btn-outline-primary" 
                                                        wire:click="printabsensi({{ $ev->idkegiatan }})">
                                                        <i class="fa fa-print"></i> Print
                                                    </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
    
                <p class="text-center">DATA DETAIL AKAN MUNCUL SETELAH DATA KEGIATAN DI KLIK</p>
                </div>
            </div>
        </div>
    </div>

    <div wire:loading wire:target="printabsensi">
            <div class="loading-container">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="loading-text">
                    Sedang Mendownload Data...
                </div>
            </div>
        </div>

        <div wire:loading wire:target="$set">
            <div class="loading-container">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="loading-text">
                    Sedang Menampilkan Data...
                </div>
            </div>
        </div>

                @if($selectedKegiatanId)
                    <!-- Modal -->
                    <div class="modal fade" id="detailPresensiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="detailPresensiModalLabel">Detail Presensi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Body Modal -->
                                <div class="modal-body">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Anggota</th>
                                                    <th>Status</th>
                                                    <th>Presensi</th>
                                                    <th>Denda</th>
                                                    <th>Status Pembayaran</th>
                                                    <th>Tanggal Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($detailPresensi ?? [] as $key => $presensi)
                                                    <tr style="background-color: {{ $presensi['denda'] > 0 ? '#ffebee' : 'white' }};">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $presensi['nama_anggota'] }}</td>
                                                        <td>{{ $presensi['status'] }}</td>
                                                        <td>{{ $presensi['presensi'] }}</td>
                                                        <td>{{ $presensi['denda'] != 0 ? currency_IDR($presensi['denda']) : '-' }}</td>
                                                        <td>
                                                            @if($presensi['statusaksi'] == 'Belum Bayar')
                                                                <i class="fa fa-times-circle text-danger"></i> <span class="text-danger">Belum Bayar</span>
                                                            @elseif($presensi['statusaksi'] == 'Lunas')
                                                                <i class="fa fa-check-circle text-success"></i> <span class="text-success">Lunas</span>
                                                            @else
                                                                {{ $presensi['statusaksi'] }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($presensi['tanggal_bayar'] == null)
                                                                -
                                                            @else
                                                                {{ $presensi['tanggal_bayar'] }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                <!-- Footer Modal -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif    
                    

   

</div>
