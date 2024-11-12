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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Denda</th>
                                        <th>Total Denda</th>
                                        <th>Total Anggota</th>
                                        <th>Total Hadir</th>
                                        <th>Total Tidak Hadir</th>
                                        <th>Keterangan</th>
                                        <th>Operator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($tabelkegiatan as $index => $ev)
                                            <tr wire:click="$set('selectedKegiatanId', {{ $ev->idkegiatan }})" 
                                                class="{{ $selectedKegiatanId == $ev->idkegiatan ? 'bg-danger text-white' : '' }}">
                                                <th style="width:2%">{{ $index + 1 }}</th>
                                                <td>{{ $ev->tanggal_kegiatan }}</td>
                                                <td>{{ $ev->nama_kegiatan }}</td>
                                                <td>{{ $ev->jenis_kegiatan }}</td>
                                                <td>{{ currency_IDR($ev->denda) }}</td>
                                                <td>{{ currency_IDR($ev->total_denda) }}</td>
                                                <td>{{ $ev->total_anggota }}</td>
                                                <td>{{ $ev->total_hadir }}</td>
                                                <td>{{ $ev->total_tidak_hadir }}</td>
                                                <td>{{ $ev->keterangan }}</td>
                                                <td>{{ $ev->user }}</td>
                                                <td>
                                                </td>
                                            <tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                    {{ $tabelkegiatan->links() }}
                                
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Detail Presensi -->
                @if($selectedKegiatanId) <!-- Tampilkan jika ada ID kegiatan yang dipilih -->
                    <div class="x_content">
                        <div class="card">
                            <h5 class="card-header text-white bg-success text-center">DATA DETAIL PRESENSI</h5>
                            <div class="card-body">                           
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Anggota</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Presensi</th>
                                            <th scope="col">Denda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailPresensi ?? [] as $key => $presensi)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $presensi['nama_anggota'] }}</td>
                                                <td>{{ $presensi['status'] }}</td>
                                                <td>{{ $presensi['presensi'] }}</td>
                                                @if($presensi['denda'] != 0)
                                                    <td>{{ currency_IDR($presensi['denda']) }}</td>
                                                @else
                                                    <td>-</td>
                                                @endif

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
