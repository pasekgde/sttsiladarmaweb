<div>
    <style>
        /* Spinner overlay */
        .loading-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            flex-direction: column;
        }

        /* Konten utama halaman */
        .body-content {
            position: relative;
            z-index: 1;  /* Pastikan konten tetap di atas spinner */
            min-height: 70vh;  /* Setel tinggi halaman agar tidak terpotong */
            padding: 20px;
            background: #f7f7f7;
        }

        /* Styling untuk teks loading */
        .loading-text {
            color: white;
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold;
        }

        /* Card dan tabel */
        .card {
            margin: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #28a745;
            color: #fff;
            padding: 15px;
            font-size: 1.2rem;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        /* Styling tombol */
        .btn-sm {
            padding: 5px 10px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        /* Modal styling */
        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #28a745;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .form-select {
            border-radius: 0.375rem; /* Membuat sudut lebih melengkung */
            border: 1px solid #ced4da; /* Mengatur warna border */
            padding: 0.75rem 1.25rem; /* Padding untuk lebih nyaman */
        }
        .form-select:focus {
            border-color: #80bdff; /* Warna border saat fokus */
            box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.25); /* Efek shadow saat fokus */
        }

            table, table th, table td {
            color: black !important;
        }

        .blink {
        color: red; /* Warna Merah */
        animation: blink-animation 1s infinite; /* Efek blink */
        }

        @keyframes blink-animation {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
        
    </style> 

    <!-- Halaman Konten -->
    <div class="body-content">
        <div class="card">
            <div class="card-header">
                DATA KEGIATAN PRESENSI
            </div>
            <div class="card-body">
            <div class="row mb-3">
                <!-- Kolom untuk dropdown filter di sebelah kiri -->
                <div class="col-md-9 text-left">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="filterSelect" class="form-label">Pilih Setingan Penikelan</label>
                            <select wire:model="penikelandata" class="form-select form-select-lg" aria-label="Pilih Kategori" wire:change="showHitungButton">
                                <option value="1">Tidak Ada Penikelan</option>
                                <option value="3">Penikelan dalam 3 Kali Tidak Hadir</option>
                                <option value="4">Penikelan dalam 4 Kali Tidak Hadir</option>
                            </select>
                            &nbsp&nbsp;
                            @if($showHitungButton)
                                <button type="button" class="btn btn-primary btn-sm" wire:click="pesanhitung">Terapkan Untuk Denda?</button>
                            @endif

                            &nbsp&nbsp;
                            @if($datapenikelan->penikelan_denda != 1)
                                <span class="blink">Tabel dibawah dilakukan penikelan Denda {{$datapenikelan->penikelan_denda}} kali</span>
                            @elseif($datapenikelan->penikelan_denda == 1)
                                <span class="blink">Tabel dibawah tidak Ada penikelan</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kolom untuk total denda di sebelah kanan -->
                <div class="col-md-3 text-right">
                    <strong class="text-danger" style="font-size: 1.5rem; font-weight: bold;">Total Denda: </strong>
                    <span class="text-danger" style="font-size: 1.5rem; font-weight: bold;">{{ currency_IDR($totalDendaKeseluruhan) }}</span>
                </div>
            </div>



                <!-- Tabel Data Anggota -->
                <div style="max-height: 500px; overflow-y: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anggota STT</th>
                                <th>Tempek</th>
                                <th>Jumlah Tidak Hadir</th>
                                <th>Jumlah Penikelan</th>
                                <th>Total Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($anggotaData as $index => $anggota)
                            <tr class="{{ $anggota['status'] === 'Nekel' ? 'bg-warning' : ''}}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $anggota['nama_anggota'] }}</td>
                                <td>{{ $anggota['tempek'] }}</td>
                                <td>{{ $anggota['jumlah_belum_bayar'] }}</td>
                                <td>{{ $anggota['nikel'] }}</td>
                                <td>{{ currency_IDR($anggota['total_denda']) }}</td>
                                <td>
                                @if($anggota['total_denda'] != 0)
                                    <a href="#" wire:click="viewModal({{ $anggota['idanggota'] }})" style="color:blue"><i class="fa fa-eye"></i> Tampilkan</a>&nbsp;&nbsp;
                                    <button type="button" class="btn btn-success btn-sm" id="bayarButton" data-idanggota="{{ $anggota['idanggota'] }}">Bayar</button>
                                @elseif($anggota['status'] === 'Nekel')
                                    <a style="color:red"><i class="fa fa-lock"></i> Nekel</a>
                                @else
                                    <a href="#" wire:click="viewModal({{ $anggota['idanggota'] }})" style="color:blue"><i class="fa fa-eye"></i> Tampilkan</a>&nbsp;&nbsp;
                                    <a href="#" style="color:green"><i class="fa fa-check-circle"></i> Lunas</a>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Spinner Loading -->
    <div wire:loading wire:target="showHitungButton">
        <div class="loading-container">
            <div class="spinner-border text-light" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="loading-text">
                Sedang Menghitung Data...
            </div>
        </div>
    </div>

    <!-- Spinner Loading -->
    <div wire:loading wire:target="viewModal">
        <div class="loading-container">
            <div class="spinner-border text-light" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="loading-text">
                Sedang Menampilkan Data...
            </div>
        </div>
    </div>

    <!-- Modal untuk Menampilkan Detail Absensi -->
    <div wire:ignore.self class="modal fade" id="modalViewAbsensi" tabindex="-1" aria-labelledby="modalViewAbsensiLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    @if($selectedAnggotaId)
                        @php
                            $anggota = \App\Models\Anggota::with(['absensis' => function($query) {
                                $query->select('absensis.*')
                                      ->join('tabel_kegiatans', 'absensis.idkegiatan', '=', 'tabel_kegiatans.idkegiatan')
                                      ->orderBy('tabel_kegiatans.created_at', 'desc');
                            }])->find($selectedAnggotaId);

                            $totalDenda = $anggota->absensis->where('status', 'Belum Bayar')->sum('denda');
                            

                                
                              
                        @endphp
                    <h5 class="modal-title" id="modalViewAbsensiLabel">{{ $anggota->nama }}</h5>
                    <div class="ms-auto">
                        @if($totalDenda != 0)
                            <span class="badge bg-danger text-light" style="font-size: 1.2rem;">Total Denda: {{ currency_IDR($totalDendaanggota) }}</span>
                        @else
                            <span class="badge bg-success text-light" style="font-size: 1.2rem;">TIDAK ADA DENDA</span>
                        @endif
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="max-height: 600px; overflow-y: auto; display: block;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Denda</th>
                                    <th>Status</th>
                                    <th>Tanggal Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anggota->absensis as $index => $absensi)
                                    <tr class="{{ $absensi->status === 'Belum Bayar' ? 'bg-danger text-white' : ''}}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $absensi->kegiatan->tanggal_kegiatan }}</td>
                                        <td>{{ $absensi->kegiatan->nama_kegiatan }}</td>
                                        <td>{{ currency_IDR($absensi->denda) }}</td>
                                        <td>{{ $absensi->status }}</td>
                                        <td>{{ $absensi->tanggal_bayar }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                        @if($totalDenda != 0)
                            <div class="alert alert-info">
                                <strong>Total Denda Awal: </strong>
                                <span class="fw-bold" style="font-size: 1.1em;">{{ currency_IDR($totaldendaawal) }}</span>
                                <br>
                                <strong>Sanksi Penikelan: </strong>
                                <span class="fw-bold" style="font-size: 1.1em;">{{ $nikelanggota }} kali</span>
                                <br>
                                <strong>Total Denda Setelah Sanksi: </strong>
                                <span class="fw-bold" style="font-size: 1.1em;">{{ currency_IDR($totalDendaanggota) }}</span>
                                <br>
                                <span style="font-size: 1em; font-style: italic;">
                                    Sesuai dengan peraturan Awig-Awig STT Sila Dharma.
                                </span>
                            </div>
                        @else
                            <div class="alert alert-success">
                                <span class="fw-bold" style="font-size: 1.1em;">Terima Kasih</span> - 
                                <span>Anda sudah melunasi kewajiban denda.</span>
                            </div>
                        @endif  
                    @endif     
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
