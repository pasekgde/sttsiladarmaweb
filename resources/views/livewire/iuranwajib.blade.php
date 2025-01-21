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

    <div wire:loading wire:target="printiuran">
        <div class="loading-container">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="loading-text">
                Sedang Mendownload Data...
            </div>
        </div>
    </div>

    <div wire:loading wire:target="showPaymentModal">
        <div class="loading-container">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="loading-text">
                Sedang Menampilkan Data...
            </div>
        </div>
    </div>
<div class="col-md-12  ">
        <div class="x_panel">
            <div class="row mb-3 align-items-center">
                <!-- Button to Add Iuran -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <button type="button" class="btn btn-primary w-100" wire:click="$emit('openModal')">Tambah Iuran</button>
                </div>

                <!-- Search Input -->
                <div class="col-md-5 mb-2 mb-md-0">
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

            <!-- Table to Display Iuran Data -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered" style="table-layout: fixed;">
                    <thead class="thead-dark">
                        <tr>
                            <th style="text-align: left; vertical-align: middle; width: 2%;">No</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Tanggal Buat</th>
                            <th style="text-align: left; vertical-align: middle; width: 13%;">Perihal</th>
                            <th style="text-align: center; vertical-align: middle; width: 4%;">Jumlah</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Total Iuran</th>
                            <th style="text-align: center; vertical-align: middle; width: 4%;">Total Anggota</th>
                            <th style="text-align: center; vertical-align: middle; width: 4%;">Sudah Bayar</th>
                            <th style="text-align: center; vertical-align: middle; width: 4%;">Belum Bayar</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Total Bayar</th>
                            <th style="text-align: center; vertical-align: middle; width: 8%;">Status</th>
                            <th style="text-align: center; vertical-align: middle; width: 24%;">Aksi</th>
                            <th style="text-align: center; vertical-align: middle; width: 7%;">Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($iurans as $index => $iuran)
                            <tr class="{{ $iuran['status'] === 'Terkirim ke Kas' ? 'bg-primary text-white' : ''}}" style="border-bottom: 1px solid #ddd; transition: background-color 0.3s ease;">
                                <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{ \Carbon\Carbon::parse($iuran->created_at)->format('d-m-Y') }}</td>
                                <td style="text-align: left; vertical-align: middle;">{{ $iuran->perihal }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{ number_format($iuran->jumlah, 0, ',', '.') }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{ number_format($iuran->total_iuran, 0, ',', '.') }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$iuran->total_anggota}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$iuran->total_yangsudahbayar}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{$iuran->total_yangbelumbayar}}</td>
                                <td style="text-align: center; vertical-align: middle;">{{ number_format($iuran->total_bayar, 0, ',', '.') }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <span class="badge {{ $iuran->status == 'Belum Lengkap' ? 'badge-danger' : ($iuran->status == 'Terkirim ke Kas' ? 'badge-primary' : 'badge-success') }}">
                                        {{ $iuran->status }}
                                    </span>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <a href="#" wire:click.prevent="showPaymentModal({{ $iuran->idiuran }})" class="btn btn-sm btn-success">
                                        <i class="fa fa-folder-open"></i> Pembayaran
                                    </a>
                                    <a href="#" wire:click.prevent="destroypesan({{$iuran->idiuran}})" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                    @if($iuran->status == 'Lengkap')
                                        @if(Auth::user()->status == 'Superadmin' || Auth::user()->status == 'Ketua')
                                            <a href="#" wire:click.prevent="yakinkirimkekasin({{ $iuran->idiuran }})" class="btn btn-sm btn-warning">
                                                <i class="fa fa-download"></i> Kirim KASIN
                                            </a>
                                        @endif
                                    @else
                                        @if($iuran->status == 'Terkirim ke Kas')
                                    <a href="#" wire:click.prevent="yakinkirimkekasin({{ $iuran->idiuran }})" class="btn btn-sm btn-primary">
                                        <i class="fa fa-download"></i> Sudah Terkirim ke Kas
                                    </a>
                                        @endif
                                    @endif
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <a href="#" id="downloadButton" wire:click.prevent="printiuran({{ $iuran->idiuran }})" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-print"></i> Print
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
            <span class="ml-2">{{ $iurans->total() }} Data</span>
        </div>

        <!-- Pagination Links -->
        <div>
            {{ $iurans->links('pagination::bootstrap-4') }}
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="iuranModal" tabindex="-1" role="dialog" aria-labelledby="iuranModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iuranModalLabel">Form Iuran</h5>
                    <button type="button" class="close" wire:click="$emit('closeModal')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Iuran -->
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="text" id="perihal" class="form-control" wire:model="perihal">
                            @error('perihal') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" id="jumlah" class="form-control" wire:model="jumlah" onkeyup="formatRupiah(this)">
                            @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

      <!-- Modal Pembayaran -->
<div wire:ignore.self class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="paymentModalLabel">Pembayaran Iuran : </h5>
                <button type="button" class="close" wire:click="$emit('closeModal')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tabel Anggota Pembayaran -->
                <div style="max-height: 500px; overflow-y: auto; display: block;">
                    <table class="table table-bordered table-striped" style="table-layout: fixed; width: 100%;">
                        <thead class="thead-light" style="position: sticky; top: 0; background-color: #343a40; z-index: 1;">
                            <tr>
                                <th style="text-align: center; vertical-align: middle; width: 5%;">Nama Anggota</th>
                                <th style="text-align: center; vertical-align: middle; width: 4%;">Jumlah Iuran</th>
                                <th style="text-align: center; vertical-align: middle; width: 4%;">Jumlah Bayar</th>
                                <th style="text-align: center; vertical-align: middle; width: 4%;">Tanggal Bayar</th>
                                <th style="text-align: center; vertical-align: middle; width: 6%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bayariuran as $payment)
                                <tr>
                                    <td>{{ $payment->nama }}</td>
                                    <td>{{ number_format($payment->jumlah_iuran, 0, ',', '.') }}</td>
                                    <td>{{ number_format($payment->jumlahbayar, 0, ',', '.') }}</td>
                                    <td>
                                        {{ $payment->tanggalbayar ? $payment->tanggalbayar : '-' }}
                                    </td>
                                    <td>
                                    @if($iuran->status !== 'Terkirim ke Kas')
                                        @if($payment->statusbayar == 'Belum Bayar')
                                            <button class="btn btn-sm btn-success" wire:click.prevent="pay({{ $payment->idanggota }})">Bayar</button>
                                        @elseif($payment->statusbayar == 'Terbayar')
                                            <button class="btn btn-sm btn-secondary" disabled>Terbayar</button>
                                            <button class="btn btn-sm btn-danger" wire:click.prevent="cancelPayment({{ $payment->idanggota }})">Batal</button>
                                        @endif
                                    @else
                                        <button class="btn btn-sm btn-danger" disabled>Sudah Terbayar</button>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="$emit('closeModal')">Tutup</button>
            </div>
        </div>
    </div>
</div>

</div>
