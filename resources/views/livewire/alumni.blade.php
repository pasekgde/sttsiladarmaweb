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
                        <!-- Search Input -->
                        <div class="col-md-8 mb-2 mb-md-0">
                            <input type="text" wire:model="search" class="form-control" placeholder="Search by Perihal">
                        </div>

                        <!-- Per Page Dropdown -->
                        <div class="col-md-4">
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
                                    <th style="width: 15%;">Alasan Keluar</th>
                                    <th style="width: 5%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alumni as $index => $alumnis)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td style="text-align: left">{{$alumnis->nama}}</td>
                                    <td>{{$alumnis->tgllahir}}</td>
                                    <td>{{$alumnis->tempek}}</td>
                                    <td>{{$alumnis->alasan}}</td>
                                    <td>
                                       -<a href="#" wire:click.prevent="dstroyconfirm({{$alumnis->idanggota}})" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mt-3">
                            <!-- Total Data Row -->
                            <div class="d-flex align-items-center">
                                <strong>Total Data:</strong>
                                <span class="ml-2">{{ $alumni->total() }} Data</span>
                            </div>

                            <!-- Pagination Links -->
                            <div>
                                {{ $alumni->links('pagination::bootstrap-4') }}
                            </div>
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




</div>
