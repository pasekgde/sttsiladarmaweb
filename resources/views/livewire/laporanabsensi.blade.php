<div>

    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>DATA ABSENSI</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="card">
                            <h5 class="card-header text-white bg-success text-center">DATA KEGIATAN PRESENSI</h5>
                            <div class="card-body">
                                <div style="max-height: 500px; overflow-y: auto; display: block;">
                                    <table class="table">
                                        <thead class="thead-fixed">
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle;">#</th>
                                                <th style="text-align: center; vertical-align: middle;">Tanggal Kegiatan</th>
                                                <th style="text-align: center; vertical-align: middle;">Nama Kegiatan</th>
                                                <th style="text-align: center; vertical-align: middle;">Jenis Kegiatan</th>
                                                <th style="text-align: center; vertical-align: middle;">Denda</th>
                                                <th style="text-align: center; vertical-align: middle;">T. Denda</th>
                                                <th style="text-align: center; vertical-align: middle;">T. Anggota</th>
                                                <th style="text-align: center; vertical-align: middle;">T. Hadir</th>
                                                <th style="text-align: center; vertical-align: middle;">T. TK</th>
                                                <th style="text-align: center; vertical-align: middle; background-color: #ffebee; color: #333;">Belum Bayar</th>
                                                <th style="text-align: center; vertical-align: middle; background-color: #abe6a1; color: #d32f2f;">Status</th>
                                                <th style="text-align: center; vertical-align: middle;">Operator</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($tabelkegiatan as $index => $ev)
                                                <tr wire:click="$set('selectedKegiatanId', {{ $ev->idkegiatan }})"
                                                    class="{{ $selectedKegiatanId == $ev->idkegiatan ? 'bg-primary text-white' : '' }}">
                                                    <th style="width:2%">{{ $index + 1 }}</th>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->tanggal_kegiatan }}</td>
                                                    <td>{{ $ev->nama_kegiatan }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->jenis_kegiatan }}</td>
                                                    <td>{{ currency_IDR($ev->denda) }}</td>
                                                    <td>{{ currency_IDR($ev->total_denda) }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->total_anggota }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->total_hadir }}</td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->total_tidak_hadir }}</td>
                                                    <td style="text-align: center; vertical-align: middle; background-color: #ffebee; color: #333;">
                                                    @if( $belumBayarCounts[$ev->idkegiatan] ?? 0  != 0)
                                                        <span class="text-danger">{{ $belumBayarCounts[$ev->idkegiatan] ?? 0 }}</span>
                                                    @else
                                                        -
                                                    @endif
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle; background-color: #abe6a1; color: #d32f2f;">
                                                        @if($belumBayarCounts[$ev->idkegiatan] ?? 0 != 0)
                                                            <i class="fa fa-times-circle text-danger"></i> <span class="text-danger">Not Complate</span>
                                                        @else
                                                        <i class="fa fa-check-circle text-success"></i> <span class="text-success">Complate</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle;">{{ $ev->user }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
    
                <p class="text-center">DATA DETAIL AKAN MUNCUL DI BAWAH SETALAH DATA KEGIATAN DI KLIK</p>
                @if($selectedKegiatanId)
                    <div class="x_content">
                        <div class="card">
                            <h5 class="card-header text-white bg-primary text-center">DATA DETAIL PRESENSI</h5>
                            <div class="card-body">                           
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Anggota</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Presensi</th>
                                            <th scope="col">Denda</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tanggal Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailPresensi ?? [] as $key => $presensi)
                                            <tr style="background-color: {{ $presensi['denda'] > 0 ? '#ffebee' : 'white' }};">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $presensi['nama_anggota'] }}</td>
                                                <td>{{ $presensi['status'] }}</td>
                                                <td>{{ $presensi['presensi'] }}</td>
                                                @if($presensi['denda'] != 0)
                                                    <td>{{ currency_IDR($presensi['denda']) }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                                <td>
                                                    @if($presensi['statusaksi'] == 'Belum Bayar')
                                                        <i class="fa fa-times-circle text-danger"></i> <span class="text-danger">Belum Bayar</span>
                                                    @elseif($presensi['statusaksi'] == 'Lunas')
                                                        <i class="fa fa-check-circle text-success"></i> <span class="text-success">Lunas</span>
                                                    @else
                                                        {{ $presensi['statusaksi'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                @if($presensi['tanggal_bayar'] == null)
                                                    -
                                                @else
                                                    {{ $presensi['tanggal_bayar'] }}
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                  
                            </div>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>

   

</div>
