<div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Responsive Layout with Multiple Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .search-card {
            max-width: 2000px;
            width: 100%;
        }
        .result-card {
            min-height: 500px;
        }
        .card-header {
            font-size: 1.25rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center py-5">
    @if($tampilcek)
    <!-- Form Pencarian -->
        <div class="row w-100 mb-4 justify-content-center">
            <div class="col-12 col-md-8 search-card">
                <div class="card shadow-lg rounded-4 border-0">
                    <div class="card-body p-5">
                        <a href="#"wire:click="redirectToLogin"  class="position-absolute top-0 start-0 ms-3 mt-3">
                            <i class="bi bi-arrow-left-circle" style="font-size: 1.5rem; color: #007bff;"></i>
                        </a>
                        <h2 class="mb-4 text-center text-primary">Cek Denda</h2>
                        <p class="text-muted mb-4 text-center">Masukkan nama anggota untuk mengecek denda.</p>

                        <form wire:submit.prevent="cekDenda" class="d-flex flex-column">
                            <input 
                                type="text" 
                                class="form-control form-control-lg mb-3"
                                wire:model="nama" 
                                placeholder="Cari Nama Anggota"
                                required 
                                autofocus
                                style="transition: all 0.3s ease; border-radius: 30px;">
                            <button type="submit" class="btn btn-primary btn-lg mb-3 rounded-pill shadow-sm" style="transition: background-color 0.3s;">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    

        <!-- Loading Spinner -->
        <div class="spinner-container" wire:loading.delay wire:target="cekDenda">
            <div class="spinner"></div>
        </div>
    @endif

    @if($tampilhasil)    
        <!-- Hasil Pencarian -->
        <div class="row w-100 justify-content-center">
            <!-- Kolom 1: Hasil Pencarian - Denda 1 -->
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                <div class="card shadow-lg rounded-4 border-0 result-card">
                    <h5 class="card-header text-white bg-primary text-center">HASIL PENCARIAN DENDA</h5>
                    <div class="card-body">
                        <!-- Example Data for Denda 1 -->
                        @if($anggota)
                            <p class="text-muted mb-4 text-center">Atas Nama :  {{ $anggota->nama }}</p>
                        @endif

                        <!-- Table with Penalty Data -->
                        @if($tidakAdaDenda)
                            <p class="alert alert-primary text-center">Anggota ini tidak memiliki denda.</p>
                            <div class="alert alert-success">
                                    <span class="fw-bold" style="font-size: 1.1em;">Terima Kasih</span> - 
                                    <span>Anda sudah melunasi kewajiban denda.</span>
                                </div>
                        @elseif($absensi && $absensi->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Denda</th>
                                        <th>Presensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($absensi as $index => $absen)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $absen->kegiatan->nama_kegiatan }}</td>
                                            <td>{{ number_format($absen->denda, 0, ',', '.') }}</td>
                                            <td>{{ $absen->presensi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Total Denda -->
                        <div class="text-center mt-3">
                            <h4 style="color: red;">Total Denda: {{ number_format($totalDendaanggota, 0, ',', '.') }}</h4>
                        </div>

                        <!-- Status -->
                            @if($totalDendaanggota != 0)
                                <div class="alert alert-info">
                                    <strong>Total Denda Awal: </strong>
                                    <span class="fw-bold" style="font-size: 1.1em;">{{ currency_IDR($totalDenda) }}</span>
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

                            <!-- Menampilkan Status Lunas -->
                            @if($statusLunas)
                                <div class="alert alert-success mt-3 text-center">
                                    Denda sudah lunas!
                                </div>
                            @else
                                <div class="alert alert-warning mt-3 text-center">
                                    Denda belum lunas.
                                </div>
                            @endif
                        @elseif(!empty($nama))
                            <p class="alert alert-danger text-center">Tidak ada data absensi untuk anggota ini atau anggota tidak ditemukan.</p>
                        @endif

                        
                    </div>
                </div>
            </div>

            <!-- Kolom 2: Hasil Pencarian - Denda 2 -->
            <div class="col-12 col-md-6">
                <div class="card shadow-lg rounded-4 border-0 result-card">
                    <h5 class="card-header text-white bg-success text-center">HASIL PENCARIAN IURAN</h5>
                    <div class="card-body">
                        <!-- Example Data for Denda 2 -->
                        @if($anggota)
                            <p class="text-muted mb-4 text-center">Atas Nama :  {{ $anggota->nama }}</p>
                        @endif

                        <!-- Table with Penalty Data -->
                        @if($tidakAdaIuran)
                            <p class="alert alert-primary text-center">Anggota ini tidak memiliki Iuran.</p>
                            <div class="alert alert-success">
                                    <span class="fw-bold" style="font-size: 1.1em;">Terima Kasih</span> - 
                                    <span>Anda sudah melunasi kewajiban iuran.</span>
                                </div>
                        @elseif($iuran && $iuran->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Perihal Iuran</th>
                                        <th>Jumlah Iuran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($iuran as $index => $iurans)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $iurans->perihal }}</td>
                                            <td>{{ number_format($iurans->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ $iurans->statusbayar }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Total Denda -->
                        <div class="text-center mt-3">
                        <h4 style="color: red;">Total Denda: {{ number_format($totalIuran, 0, ',', '.') }}</h4>
                        </div>

                        <!-- Status -->
                        @if($totalIuran != 0)
                            <div class="alert alert-danger">
                                <span class="fw-bold" style="font-size: 1.1em;">Mohon Lunasi</span> - 
                                <span>Tunggakan iuran anda.</span>
                            </div>
                        @else
                            <div class="alert alert-success">
                                <span class="fw-bold" style="font-size: 1.1em;">Terima Kasih</span> - 
                                <span>Anda sudah melunasi kewajiban iuran.</span>
                            </div>
                        @endif

                            <!-- Menampilkan Status Lunas -->
                            @if($iuranLunas)
                                <div class="alert alert-success mt-3 text-center">
                                    Iuran sudah lunas!
                                </div>
                            @else
                                <div class="alert alert-warning mt-3 text-center">
                                    Iuran belum lunas.
                                </div>
                            @endif
                        @elseif(!empty($nama))
                            <p class="alert alert-danger text-center">Tidak ada data absensi untuk anggota ini atau anggota tidak ditemukan.</p>
                        @endif


                        
                    </div>
                </div>
            </div>
            <!-- Back to Search -->
            <div class="card-body">
                <div class="text-center mt-3">
                    <button wire:click="resetForm" class="btn btn-danger btn-back">
                        Kembali ke Form Pencarian
                    </button>
                </div>
            </div>

        </div>
    </div>
    @endif

    <!-- Bootstrap JS (optional for some interactive elements like modals or dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</div>
