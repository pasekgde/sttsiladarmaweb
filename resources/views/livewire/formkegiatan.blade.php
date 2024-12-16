<div>
    
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <!-- Card untuk Kas Masuk -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kas Masuk : {{$sumkasmasuk}}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <!-- Card untuk Kas Keluar -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Kas Keluar : {{$sumkaskeluar}}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <!-- Card untuk Saldo -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Saldo : {{$saldo}}</h5>
                </div>
            </div>
        </div>

    
    <!-- Kolom Kiri: Data Kas -->
    <div class="col-md-3 col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Buat Baru Data Rincian Kegiatan</h5>
            </div>
            <div class="card-body">
                @include('livewire.crudkegiatan')
                
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Data Rincian Kegiatan -->
    <div class="col-md-9 col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Data Rincian Kegiatan</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <label for="perpage" class="form-label form">Tampilkan</label>
                        <select id="perpage" class="form-select d-inline w-auto form-control" wire:model="perpage">
                            <option value="15">15</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="d-flex">
                        <input type="text" wire:model="search" class="form-control me-2" placeholder="Search...">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Tanggal KAS</th>
                            <th>Jenis KAS</th>
                            <th>Keterangan</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datakegiatan as $index => $ev)
                            <tr>
                                <td>{{$datakegiatan->firstItem() + $index}}</td>
                                <td>{{$ev->tglkas}}</td>
                                <td>{{$ev->jeniskas}}</td>
                                <td>{{$ev->keterangan}}</td>
                                @if ($ev->qty == '' || $ev->qty == 0)
                                    <td>-</td>
                                @else
                                    <td>{{$ev->qty}}</td>
                                @endif
                                <td>{{currency_IDR($ev->harga)}}</td>
                                <td>{{currency_IDR($ev->jumlah)}}</td>
                                <td>{{$ev->user}}</td>
                                <td class="text-center">
                                @if ($ev->status == 'Belum')
                                    <a href="#" wire:click="edit({{$ev->id}})" class="text-primary"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a href="#" wire:click.prevent="destroypesan({{$ev->id}})" class="text-danger"><i class="fa fa-trash-o"></i> Delete</a>
                                @else
                                    <a href="#" class="text-primary">Selesai</a>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ $datakegiatan->total() }} Item Rows</span>
                    <div>
                        {{ $datakegiatan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>




        
