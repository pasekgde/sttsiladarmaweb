<div>
    <div class="col-md-12  ">
        <div class="x_panel">
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
                            <th style="text-align: center; vertical-align: middle; width: 15%;">Nama Anggota</th>
                            <th style="text-align: left; vertical-align: middle; width: 5%;">Status</th>
                            <th style="text-align: center; vertical-align: middle; width: 5%;">Jumlah Bayar</th>
                            <th style="text-align: center; vertical-align: middle; width: 5%;">Terakhir Bayar</th>
                            <th style="text-align: center; vertical-align: middle; width: 4%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($anggotaNekel as $index => $anggota)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $anggota->nama }}</td>
                            <td>{{ $anggota->status }}</td>
                            <td>
                                @if ($anggota->penekelan->isNotEmpty())
                                    {{ number_format($anggota->penekelan->last()->bayarpenekelan) }}
                                @else
                                    Belum Ada Pembayaran
                                @endif
                            </td>
                            <td>
                                @if ($anggota->penekelan->isNotEmpty())
                                    {{ $anggota->penekelan->last()->tanggalbayar }}
                                @else
                                    Belum Ada Pembayaran
                                @endif
                            </td>
                            <td>
                                <button wire:click="showBayarModal({{ $anggota->idanggota }})" class="btn btn-sm btn-success">Bayar</button>
                                <button wire:click="showHistori({{ $anggota->idanggota }})" class="btn btn-sm btn-info">View</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-3">
        <!-- Total Data Row -->
        <div class="d-flex align-items-center">
            <strong>Total Data:</strong>
            <span class="ml-2">{{ $anggotaNekel->total() }} Data</span>
        </div>

        <!-- Pagination Links -->
        <div>
        {{ $anggotaNekel->links('pagination::bootstrap-4') }}
        </div>
    </div>
    </div>

</div>


<!-- Modal Bayar -->
    <div wire:ignore.self class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="iuranModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iuranModalLabel">Bayar Penekelan : {{$namaAnggota}}</h5>
                    <button type="button" class="close" wire:click="closeBayarModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                            <div class="form-group">
                                <label for="bayarpenekelan">Bayar Penekelan</label>
                                <input type="number" wire:model="bayarpenekelan" onkeyup="formatRupiah(this)" class="form-control" id="bayarpenekelan" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggalbayar">Tanggal Bayar</label>
                                <input type="date" wire:model="tanggalbayar"  class="form-control" id="tanggalbayar" required>
                            </div>
                            <button type="button" wire:click="bayarPenekelan" class="btn btn-primary mt-3">Bayar</button>
                    
                </div>
                <div class="modal-footer">
                <!-- Tombol Close di bawah -->
                    <button type="button" class="btn btn-secondary" wire:click="closeBayarModal" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="iuranModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iuranModalLabel">History Pembayaran Penekelan : {{$namaAnggota}}</h5>
                    <button type="button" class="close" wire:click="closeBayarModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="max-height: 700px; overflow-y: auto; display: block;">
                        <table class="table table-bordered" style="table-layout: fixed; width: 100%;">
                            <thead class="thead-dark" style="position: sticky; top: 0; background-color: #343a40; z-index: 1;">
                                <tr>
                                    <th style="text-align: left; vertical-align: middle; width: 2%;">No</th>
                                    <th style="text-align: center; vertical-align: middle; width: 15%;">Tanggal Bayar</th>
                                    <th style="text-align: center; vertical-align: middle; width: 5%;">Jumlah Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($historiPembayaran as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->tanggalbayar }}</td>
                                    <td>Rp. {{ number_format($item->bayarpenekelan) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>   
                    </div>
                    <div class="modal-footer">
                <!-- Tombol Close di bawah -->
                    <button type="button" class="btn btn-secondary" wire:click="closeBayarModal" data-dismiss="modal">Tutup</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .table {
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: bold;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:disabled {
            background-color: #ced4da;
            border-color: #ced4da;
        }
    </style>

</div>
