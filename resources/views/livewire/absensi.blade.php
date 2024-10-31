<div>

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
                                        <input type="date" wire:model="tanggal_kegiatan" required="required" class="form-control @error('tanggal_kegiatan') is-invalid @enderror">
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
                                        <input type="text" wire:model="denda" required="required" class="form-control @error('denda') is-invalid @enderror">
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
                                    <div class="x_content">
                                        <table class="table table-striped">
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
                                                <tr>
                                                    <th style="width:2%">{{ $index + 1 }}</th>
                                                    <td>{{ $ev->nama }}</td>
                                                    <td>{{ $ev->tempek }}</td>
                                                    <td>{{ $ev->status }}</td>
                                                    <td>
                                                        <select class="form-control @error('presensi') is-invalid @enderror" wire:model="presensi.{{ $index }}">
                                                            <option value="">Pilih Status</option>
                                                            <option value="Hadir" selected>Hadir</option>
                                                            <option value="Izin">Izin</option>
                                                            <option value="Sakit">Sakit</option>
                                                            <option value="TK">Tanpa Keterangan (TK)</option>
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
                            <table class="table">
                              <tr>
                                  <td>Tanggal Kegiatan:</td>
                                  <td><strong>{{$tanggal_kegiatan}}</strong></td>
                              </tr>
                              <tr>
                                  <td>Nama Kegiatan:</td>
                                  <td><strong>{{$nama_kegiatan}}</strong></td>
                              </tr>
                              <tr>
                                  <td>Jenis Kegiatan:</td>
                                  <td><strong>{{$jenis_kegiatan}}</strong></td>
                              </tr>
                              <tr>
                                  <td>Denda:</td>
                                  <td><strong>{{$denda}}</strong></td>
                              </tr>
                              <tr>
                                  <td>Keterangan:</td>
                                  <td><strong>{{$keterangan}}</strong></td>
                              </tr>
                            </table>
                            <table class="table table-striped">
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
                                    <tr>
                                        <th style="width:2%">{{ $index + 1 }}</th>
                                        <td>{{ $ev->nama }}</td>
                                        <td>{{ $ev->tempek }}</td>
                                        <td>{{ $ev->status }}</td>
                                        <td>
                                            <input type="text" disabled class="form-control" value="{{ $presensi[$index] ?? 'N/A' }}">
                                        </td>
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
                        <!-- End SmartWizard Content -->
                    </div>
                </div>
            </div>
        </div>

</div>