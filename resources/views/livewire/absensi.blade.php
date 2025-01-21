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
    
    <div wire:loading wire:target="submitForm">
        <div class="loading-container">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="loading-text">
                Sedang Membuat Absensi...
            </div>
        </div>
    </div>

    <div wire:loading wire:target="firstStepSubmit">
        <div class="loading-container">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="loading-text">
                Lanjut ke tahap 2...
            </div>
        </div>
    </div>

    <div wire:loading wire:target="secondStepSubmit">
        <div class="loading-container">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="loading-text">
                Lanjut ke tahap 3...
            </div>
        </div>
    </div>

          <div class="x_content">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Buat Data Absensi <small>Stt Sila Darma</small></h2>
                         <div class="clearfix"></div>
                    </div>
        
                    <div class="x_content">
                    <!-- Smart Wizard -->
                      <div class="stepwizard">
	                      <div class="stepwizard-row setup-panel">
		                      <div class="stepwizard-step">
	                          <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">STEP 1</a>
                                  <p>Form Kegiatan</p>
                          </div>
                          <div class="stepwizard-step">
                              <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">STEP 2</a>
                              <p>Input Data Presensi</p>
                          </div>
                          <div class="stepwizard-step">
                              <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}">STEP 3</a>
                              <p>Data Presensi</p>
                          </div>
                        </div>
                      </div>

                      <!-- FORM STEP 1 -->
                          <div class="{{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
                            <form class="form-horizontal form-label-left">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Kegiatan <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="datepicker" wire:model="tanggal_kegiatan" required="required" class="form-control @error('tanggal_kegiatan') is-invalid @enderror" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nama Kegiatan <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" wire:model="nama_kegiatan" required="required" class="form-control @error('nama_kegiatan') is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Jenis kegiatan</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control @error('jenis_kegiatan') is-invalid @enderror" wire:model="jenis_kegiatan">
                                            <option selected>Pilih Menu</option>
                                            <option value="Ngayah">Ngayah</option>
                                            <option value="Tedun">Tedun</option>
                                            <option value="Paum">Paum</option>
                                            <option value="Sangkep">Sangkep</option>
                                            <option value="Acara Lain">Acara Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Denda</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" wire:model="denda" required="required" oninput="formatRupiah(this)" class="form-control @error('denda') is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">keterangan <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" wire:model="keterangan" class="form-control @error('keterangan') is-invalid @enderror" required="required">
                                    </div>
                                </div>
                                  <div class="ln_solid"></div>
                                  <div class="tombolditengah">
                                      <button type="button" class="btn btn-success" wire:click="firstStepSubmit">Lanjutkan</button>
                                </div>
                            </form>
                          </div>

                          <!-- FORM STEP 2 -->
                          <div class="{{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
                            <div class="row">
                                <div class="col-md-12 col-sm-12  ">
                                    <div class="table-responsive">
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr>
                                                <th>#</th>
                                                <th>Nama Anggota</th>
                                                <th>Tempek</th>
                                                <th>Status</th>
                                                <th>Presensi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @foreach ($dataanggota as $index => $ev)
                                                <tr class="{{ $ev['status'] === 'Nekel' ? 'bg-warning' : ''}}">
                                                    
                                                    <th style="width:2%">{{ $index + 1 }}</th>
                                                    <td>{{ $ev->nama }}</td>
                                                    <td>{{ $ev->tempek }}</td>
                                                    <td>{{ $ev->status }}</td>
                                                    <td>
                                                        <select class="form-control @error('presensi') is-invalid @enderror" wire:model="presensi.{{ $index }}" @if($ev->status === 'Nekel') disabled @endif>
                                                            <option value="">Pilih Status</option>
                                                            <option value="Hadir" selected>Hadir</option>
                                                            <option value="Tidak Hadir">Tidak Hadir/(TK)</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                             
                                </div>
                            </div>
                              <div class="ln_solid"></div>
                                 <div class="tombolditengah">
                                      <button type="button" class="btn btn-danger" wire:click="back(1)">Kembali</button>
                                      <button type="button" class="btn btn-success" wire:click="secondStepSubmit">Lanjutkan</button>
                                  </div>
                          </div>
                          
                         <!-- FORM STEP 3 -->
                          <div class="{{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3" >
                            <div class="container mt-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <h5 class="card-header text-white bg-primary text-center">KEGIATAN HARI INI</h5>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Tanggal Kegiatan</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="{{ $tanggal_kegiatan }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Nama Kegiatan</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="{{ $nama_kegiatan }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Jenis Kegiatan</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="{{ $jenis_kegiatan }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Denda</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="{{ $denda }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Keterangan</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="{{ $keterangan }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class= "col-md-9">
                                        <div class="card">
                                            <h5 class="card-header text-white bg-success text-center">DATA PRESENSI ANGGOTA</h5>
                                            <div class="card-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                        <th>#</th>
                                                        <th>Nama Anggota</th>
                                                        <th>Tempek</th>
                                                        <th>Status</th>
                                                        <th>Presensi</th>
                                                        <th>Denda</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach ($dataanggota as $index => $ev)
                                                        <tr class="{{ $presensi[$index] === 'Tidak Hadir' ? 'bg-danger' : ''}}">
                                                            <th style="width:2%">{{ $index + 1 }}</th>
                                                            <td>{{ $ev->nama }}</td>
                                                            <td>{{ $ev->tempek }}</td>
                                                            <td>{{ $ev->status }}</td>
                                                            <td>
                                                               {{ $presensi[$index] ?? 'N/A' }}
                                                            </td>
                                                            @if ($presensi[$index] === 'Hadir')

                                                                <td>-</td>    
                                                            @else

                                                                <td>{{ $denda }}</td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="ln_solid"></div>
                                                    <div class="tombolditengah">
                                                        <button type="button" class="btn btn-danger" wire:click="back(2)">Kembali</button>
                                                        <button type="button" class="btn btn-success" wire:click="submitForm()">Simpan Presensi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <h5 class="card-header text-white bg-info text-center">INFO PRESENSI</h5>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Total Anggota</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="{{ $totalAnggota }} Orang">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Total Hadir</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="{{ $totalHadir }} Orang">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Total Tidak Hadir</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="{{ $totalTidakHadir }} Orang">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Total Denda</label>
                                                    <div class="col-sm-7">
                                                    <input type="text" class="form-control" disabled value="Rp. {{ number_format($totalDenda, 0, ',', '.') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>  
                        </div>
                        <!-- End SmartWizard Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
