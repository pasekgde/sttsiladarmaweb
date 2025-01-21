<div>
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
                    Data Alumni Anggota STT SIla Darma
                </div>
                <div class="card-body">
                    <div class="row mb-3 align-items-center">
                        <!-- Button to Add Iuran -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalViewAjukan">Ajukan Data</button>
                        </div>

                        <!-- Search Input -->
                        <div class="col-md-7 mb-2 mb-md-0">
                            <input type="text" wire:model="search" class="form-control" placeholder="Search by Perihal">
                        </div>

                        <!-- Per Page Dropdown -->
                        <div class="col-md-2">
                            <select wire:model="perPage" class="form-control">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                        <!-- Tabel Data Anggota -->
                        <table class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 15%;">Nama</th>
                                    <th style="width: 5%;">Tanggal Lahir</th>
                                    <th style="width: 3%;">Tempek</th>
                                    <th style="width: 3%;">Status</th>
                                    <th style="width: 5%;">Alasan Keluar</th>
                                    <th style="width: 5%;">Kewajiban Iuran</th>
                                    <th style="width: 7%;">Report</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($out as $index => $outs)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td style="text-align: left">{{$outs->nama}}</td>
                                    <td>{{$outs->tgllahir}}</td>
                                    <td>{{$outs->tempek}}</td>
                                    <td>{{$outs->status}}</td>
                                    <td>{{$outs->alasankeluar}}</td>

                                    <td style="text-align: left">
                                        @if($outs->iuranStatus == 'false')
                                            <i class="text-danger">
                                                <i class="fa fa-times-circle"></i> Masih Ada Iuran
                                            </i>
                                        @else
                                            <i class="text-success">
                                                <i class="fa fa-check-circle"></i> Iuran Lunas
                                            </i>
                                        @endif
                                        <br>
                                        @if($outs->dendaStatus == 'false')
                                            <i class="text-danger">
                                                <i class="fa fa-times-circle"></i> Masih Ada Denda
                                            </i>
                                        @else
                                            <i class="text-success">
                                                <i class="fa fa-check-circle"></i> Denda Lunas
                                            </i>
                                        @endif
                                    </td>

                                    <td>
                                        @if($outs->statusKeluar == 'false')
                                            <a href="#" wire:click.prevent="printout({{ $outs->idanggota }})" class="btn btn-sm btn-danger"><i class="fa fa-print"></i> Cetak Tunggakan</a>
                                        @else
                                            <a href="#" wire:click.prevent="prinpengajuan({{ $outs->idanggota }})" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Cetak Pengajuan</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($outs->statusKeluar == 'false')
                                            <a href="#"><i class="fa fa-warning text-danger"> Belum Terpenuhi</i></a>
                                            <a href="#" wire:click.prevent="dstroyconfirm({{$outs->idanggota}})" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        @else
                                            @if($outs->statusanggota == 'Alumni')
                                                <i class="text-success">
                                                    <i class="fa fa-check-circle"></i> Alumni &nbsp;
                                                </i>
                                            @else
                                                <a href="#" wire:click.prevent="yakinsetuju({{$outs->idanggota}})" class="btn btn-sm btn-warning"><i class="fa fa-warning"></i> Setujui</a>
                                            @endif
                                            <a href="#" wire:click.prevent="dstroyconfirm({{$outs->idanggota}})" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mt-3">
                            <!-- Total Data Row -->
                            <div class="d-flex align-items-center">
                                <strong>Total Data:</strong>
                                <span class="ml-2">{{ $out->total() }} Data</span>
                            </div>

                            <!-- Pagination Links -->
                            <div>
                                {{ $out->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Spinner Loading -->
        <div wire:loading wire:target="printout">
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
        <div wire:loading wire:target="prinpengajuan">
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
        <div wire:ignore.self class="modal fade" id="modalViewAjukan" tabindex="-1" aria-labelledby="modalViewAjukanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewAjukanLabel">Pengajuan Keluar Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk memilih nama anggota -->
                <div class="mb-3">
                    <label for="anggotaSelect" class="form-label">Cari Anggota</label>
                    <select wire:model="anggotaId" id="anggotaSelect" class="form-select" style="width: 100%">
                        <option value="">Pilih Anggota</option>
                        @foreach($anggotaList as $anggota)
                            <option value="{{ $anggota->idanggota }}">{{ $anggota->nama }} - {{$anggota->tempek}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Form untuk menampilkan data anggota yang dipilih -->
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="idAnggota" class="form-label">ID Anggota :</label>
                        <input type="text" id="idAnggota" class="form-control" wire:model="anggotaId" readonly>
                        @error('anggotaId') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="namaAnggota" class="form-label">Nama :</label>
                        <input type="text" id="namaAnggota" class="form-control" wire:model="anggotaName" readonly>
                        @error('anggotaName') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="tanggalLahir" class="form-label">Tanggal Lahir :</label>
                        <input type="text" id="tanggalLahir" class="form-control" wire:model="tanggalLahir" readonly>
                        @error('tanggalLahir') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="pekerjaan" class="form-label">Pekerjaan :</label>
                        <input type="text" id="pekerjaan" class="form-control" wire:model="pekerjaan" readonly>
                        @error('pekerjaan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="tempek" class="form-label">Tempek :</label>
                        <input type="text" id="tempek" class="form-control" wire:model="tempek" readonly>
                        @error('tempek') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status :</label>
                        <input type="text" id="status" class="form-control" wire:model="status" readonly>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
 
                
                <div class="mb-3">
                    <label for="alasanKeluar" class="form-label">Alasan Keluar :</label>
                    <textarea id="alasanKeluar" class="form-control" rows="3" wire:model="alasanKeluar"></textarea>
                    @error('alasanKeluar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="store" class="btn btn-primary" data-bs-dismiss="modal">Ajukan</button>
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#anggotaSelect').select2({
                placeholder: 'Cari Anggota...',
            });

            $('#anggotaSelect').on('change', function() {
                @this.set('anggotaId', $(this).val());
            });
        });
    </script>
@endpush



</div>
