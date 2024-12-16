<div>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Pilih Laporan Kegiatan</h5>
                    <small>Pilih kegiatan yang akan Dilaporan</small>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="max-height: 620px; overflow-y: auto; display: block;">
                        <thead class="table-dark text-center">
                            <tr>
                                <th style="text-align: center; vertical-align: middle; width: 2%;">#</th>
                                <th style="text-align: center; vertical-align: middle; width: 30%;">Nama Kegiatan</th>
								<th style="text-align: center; vertical-align: middle; width: 10%;">Kas Masuk</th>
								<th style="text-align: center; vertical-align: middle; width: 10%;">Kas Keluar</th>
								<th style="text-align: center; vertical-align: middle; width: 10%;">Saldo</th>
                                <th style="text-align: center; vertical-align: middle; width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($data as $keg)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">{{ $no++ }}</td>
                                <td style="text-align: left; vertical-align: middle;">{{ $keg->namakegiatan }}</td>
								<td style="text-align: left; vertical-align: middle;">{{ currency_IDR ($keg->kasmasuk) }}</td>
								<td style="text-align: left; vertical-align: middle;">{{ currency_IDR ($keg->kaskeluar) }}</td>
								<td style="text-align: left; vertical-align: middle;">{{ currency_IDR ($keg->saldo) }}</td>
                                <td class="text-center">
                                    <a href="{{ url('/pililaporan/'.$keg->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-check-circle"></i> Pilih Untuk Cetak Laporan
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">

                </div>
            </div>
        </div>
    </div>
</div>

</div>
