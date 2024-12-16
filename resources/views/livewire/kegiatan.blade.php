<div>


        <div class="row">
            <!-- Data Kegiatan -->
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Kegiatan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-auto">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createKegiatanModal">
                                    Tambah Kegiatan
                                </button>
                            </div>
                            <!-- Dropdown for Per Page -->
                            <div class="col-auto">
                                <select id="perpage" class="form-select form-control" wire:model="perpage">
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <!-- Search Bar -->
                            <div class="col">
                                <div class="input-group">
                                    <input type="text" wire:model="searchTerm" class="form-control" placeholder="Search for...">
                                    <button class="btn btn-primary" type="button">Go</button>
                                </div>
                            </div>
                        </div>

                        <!-- Table Data -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle; width: 2%;">No</th>
                                        <th style="text-align: center; vertical-align: middle; width: 4%;">Kode Kegiatan</th>
                                        <th style="text-align: center; vertical-align: middle; width: 5%;">Tgl Pembuatan</th>
                                        <th style="text-align: center; vertical-align: middle; width: 13%;">Nama Kegiatan</th>
                                        <th style="text-align: center; vertical-align: middle; width: 13%;">Deskripsi</th>
                                        <th style="text-align: center; vertical-align: middle; width: 5%;">User</th>
                                        <th style="text-align: center; vertical-align: middle; width: 10%;">Hak Akses</th>
                                        <th style="text-align: center; vertical-align: middle; width: 16%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datakegiatan as $index => $kegiatan)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">{{ $datakegiatan->firstItem() + $index }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $kegiatan->kodekegiatan }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $kegiatan->tglpembuatan }}</td>
                                            <td style="text-align: left; vertical-align: middle;">{{ $kegiatan->namakegiatan }}</td>
                                            <td style="text-align: left; vertical-align: middle;">{{ $kegiatan->deskripsi }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $kegiatan->user }}</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                @if($kegiatan->pengguna) 
                                                    @if(count($kegiatan->user_names) > 1)
                                                        @foreach($kegiatan->user_names as $index => $userName)
                                                            {{ $userName }}{{ $loop->last ? '' : ',' }}
                                                        @endforeach
                                                    @else
                                                        {{ $kegiatan->user_names[0] ?? '-' }}
                                                    @endif
                                                @else
                                                    - <!-- Jika pengguna kosong -->
                                                @endif
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                @if($kegiatan->status == 'Belum')
                                                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createKegiatanModal" wire:click="edit({{ $kegiatan->id }})">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-danger" wire:click.prevent="destroypesan({{ $kegiatan->id }})">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-primary" wire:click.prevent="yakinselesai({{ $kegiatan->id }})">
                                                        <i class="fa fa-download"></i> Selesai & Kirim KASIN
                                                    </a>
                                                @else
                                                    <a href="#" class="btn btn-sm btn-danger" wire:click.prevent="destroypesan({{ $kegiatan->id }})">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-secondary">
                                                        <i class="fa fa-checked"></i> Sudah Selesai
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination and Total Count -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <p class="mb-0">{{ $datakegiatan->total() }} Item Rows</p>
                            <nav>
                                {{ $datakegiatan->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="createKegiatanModal" tabindex="-1" aria-labelledby="createKegiatanModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createKegiatanModalLabel">Buat Baru Data Kas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('livewire.createkegiatan')
                </div>
            </div>
        </div>
    </div>



</div>




        
