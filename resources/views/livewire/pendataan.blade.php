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
                    Confirm Anggota STT SIla Darma
                </div>
                <div class="card-body">
                        <!-- Tabel Data Anggota -->
                        <table class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 15%;">Nama</th>
                                    <th style="width: 5%;">Tanggal Lahir</th>
                                    <th style="width: 5%;">Umur</th>
                                    <th style="width: 5%;">Kesibukan</th>
                                    <th style="width: 3%;">Tempek</th>
                                    <th style="width: 3%;">Status</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datapendataan as $index => $data)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td style="text-align: left">{{$data->nama}}</td>
                                    <td>{{$data->tglLahir}}</td>
                                    <td>{{$data->umur}}</td>
                                    <td>{{$data->pekerjaan}}</td>
                                    <td>{{$data->tempek}}</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                        <a href="#" wire:click.prevent="setujui({{$data->id}})" class="btn btn-sm btn-primary">
                                                <i class="fa fa-check"></i> 
                                        </a>
                                        <a href="#" wire:click.prevent="yakintolak({{$data->id}})" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
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

</div>
