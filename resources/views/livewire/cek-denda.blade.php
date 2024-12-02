<div>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            
            <!-- Card Form Pencarian -->
            <div class="card card-container shadow-lg rounded-4 @if($denda || $loading) hide @endif">
                <div class="card-body p-5 position-relative">
                    <a href="#" wire:click="redirectToLogin" class="position-absolute top-0 start-0 ms-3 mt-3">
                        <i class="bi bi-arrow-left-circle" style="font-size: 1.5rem; color: #007bff;"></i>
                    </a>
                    
                    <h2 class="mb-4 text-center">Cek Denda</h2>
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
                        
                        <button type="submit" class="btn btn-primary btn-lg mb-3" style="border-radius: 30px; transition: background-color 0.3s;">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </form>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div class="spinner-container" wire:loading.delay wire:target="cekDenda">
                <div class="spinner"></div>
            </div>

            <!-- Card Hasil Pencarian -->
            <div class="result-container @if($anjing) show @endif">
                <div class="card">
                    <h5 class="card-header text-white bg-primary text-center">HASIL PENCARIAN</h5>
                        <div class="card-body">                           
                            @if($anggota)
                            <p class="text-muted mb-4 text-center">Atas Nama :  {{ $anggota->nama }}</p>
                            @endif

                            <!-- Hasil Cek Denda -->
                            @if($tidakAdaDenda)
                                    <p class="alert alert-primary text-center">Anggota ini tidak memiliki denda.</p>
                                @elseif($absensi && $absensi->isNotEmpty())
                                    <!-- Hasil Cek Denda -->
                                    <table class="table table-striped">
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

                                    <!-- Menampilkan Total Denda -->
                                    <div class="text-center mt-3">
                                        <h4 style="color: red;">Total Denda: {{ number_format($totalDenda, 0, ',', '.') }}</h4>
                                    </div>

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

                            <!-- Tombol Kembali -->
                            <div class="text-center">
                                <button wire:click="resetForm" class="btn-back">
                                    Kembali ke Form Pencarian
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>
