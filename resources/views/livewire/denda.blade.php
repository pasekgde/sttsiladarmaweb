<div>

    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                <div class="d-flex justify-content-end mb-3">
                                    <strong class="text-danger" style="font-size: 1.5rem; font-weight: bold;">Total Denda: </strong>
                                    <span class="text-danger" style="font-size: 1.5rem; font-weight: bold;">{{ currency_IDR($totalDendaKeseluruhan) }}</span>
                                </div>

                    <div class="x_content">
                        <div class="card">
                            <h5 class="card-header text-white bg-success text-center">DATA KEGIATAN PRESENSI</h5>
                            <div class="card-body"><!-- Total Denda di pojok kanan atas -->
                                <div style="max-height: 700px; overflow-y: auto; display: block;">
                                    <table class="table">
                                        <thead class="thead-fixed">
                                            <tr>
                                                <th style="width:2%; text-align: center; vertical-align: middle;">#</th>
                                                <th style="text-align: left; vertical-align: middle;">Nama Anggota STT</th>
                                                <th style="text-align: center; vertical-align: middle;">Tempek</th>
                                                <th style="text-align: center; vertical-align: middle;">Jumlah TK</th>
                                                <th style="text-align: center; vertical-align: middle;">Total Denda</th>
                                                <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($anggotaData as $index => $anggota)
                                            <tr class="{{ $anggota['status'] === 'Nekel' ? 'bg-warning' : ''}}">
                                                <td style="width:2%; text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
                                                <td style="text-align: left; vertical-align: middle;">{{ $anggota['nama_anggota'] }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $anggota['tempek'] }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $anggota['jumlah_belum_bayar'] }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ currency_IDR($anggota['total_denda']) }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                @if($anggota['total_denda'] != 0)
                                                    <a href="#" wire:click="viewModal({{ $anggota['idanggota'] }})" style="color:blue"><i class="fa fa-eye"></i> Tampilkan </a>&nbsp&nbsp&nbsp
                                                    <button type="button" class="btn btn-success btn-sm" id="bayarButton" data-idanggota="{{ $anggota['idanggota'] }}">Bayar</button>
                                                @elseif($anggota['status'] === 'Nekel')
                                                <a style="color:red"><i class="fa fa-lock"></i> Nekel </a>
                                                @else
                                                    <a href="#" wire:click="viewModal({{ $anggota['idanggota'] }})" style="color:blue"><i class="fa fa-eye"></i> Tampilkan </a>&nbsp&nbsp&nbsp
                                                    <a href="#" style="color:green"><i class="fa fa-check-circle"></i> Lunas </a>
                                                @endif
                                                
                                                <!-- @if($anggota['total_denda'] != 0)
                                                    <button wire:click="viewModal({{ $anggota['idanggota'] }})" class="btn btn-info btn-sm">View</button>
                                                    <button type="button" class="btn btn-success btn-sm" id="bayarButton" data-idanggota="{{ $anggota['idanggota'] }}">Bayar</button>
                                                @else
                                                    <button wire:click="viewModal({{ $anggota['idanggota'] }})" class="btn btn-info btn-sm">View</button>
                                                    <button type="button" class="btn btn-info btn-sm">Lunas</button>
                                                @endif -->
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>

        <!-- Modal untuk Menampilkan Detail Absensi yang Tidak Hadir -->
    <div wire:ignore.self class="modal fade" id="modalViewAbsensi" tabindex="-1" aria-labelledby="modalViewAbsensiLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                @if($selectedAnggotaId)
                        @php
                            $anggota = \App\Models\Anggota::with(['absensis' => function($query) {
                                $query->select('absensis.*') // Ambil semua kolom dari tabel absensi
                                    ->join('tabel_kegiatans', 'absensis.idkegiatan', '=', 'tabel_kegiatans.idkegiatan')
                                    ->orderBy('tabel_kegiatans.created_at', 'desc');
                            }])->find($selectedAnggotaId);
                            $totalDenda = $anggota->absensis->where('absensis.status', 'Belum Bayar')->sum('denda');
                        @endphp
                    <h5 class="modal-title" id="modalViewAbsensiLabel">{{$anggota->nama}}</h5>
                    <div class="ms-auto">
                        @if($totaldendaanggota != 0)
                            <span class="badge bg-danger text-light" style="font-size: 1.2rem;">Total Denda: {{ currency_IDR($totaldendaanggota) }}</span>
                        @else
                            <span class="badge bg-success text-light" style="font-size: 1.2rem;">TIDAK ADA DENDA</span>
                        @endif
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div style="max-height: 600px; overflow-y: auto; display: block;">
                    <!-- Tampilkan Detail Absensi yang Tidak Hadir -->
                                <table class="table">
                                    <thead class="thead-fixed">
                                        <tr>
                                            <th style="width:2%; text-align: center; vertical-align: middle;">#</th>
                                            <th style="text-align: left; vertical-align: middle;">Tanggal Kegiatan</th>
                                            <th style="text-align: center; vertical-align: middle;">Nama Kegiatan</th>
                                            <th style="text-align: center; vertical-align: middle;">Denda</th>
                                            <th style="text-align: center; vertical-align: middle;">Status</th>
                                            <th style="text-align: center; vertical-align: middle;">Tanggal Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($anggota->absensis as $index => $absensi)
                                        <tr class="{{ $absensi->status === 'Belum Bayar' ? 'bg-danger text-white' : ''}}">
                                            <td style="width:2%; text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                                            <td style="text-align: left; vertical-align: middle;">{{ $absensi->kegiatan->nama_kegiatan }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $absensi->kegiatan->tanggal_kegiatan }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ currency_IDR($absensi->denda) }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $absensi->status }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $absensi->tanggal_bayar }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
