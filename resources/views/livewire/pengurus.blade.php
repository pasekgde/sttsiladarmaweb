<div>

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Data Informasi Pengurus</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">


          <div class="col-md-7 col-sm-7 " style="border:0px solid #e5e5e5;">

            <div class="">
              <h2>Nama Ketua STT : <strong>{{ $data->ketua ?? 'Belum Diisi' }}</strong></h2>  
            </div>
            <br />

            <div class="">
              <h2>Nama Sekretaris STT : <strong>{{ $data->sekretaris ?? 'Belum Diisi' }}</strong></h2>  
            </div>
            <br />

            <div class="">
              <h2>Nama Bendahara STT : <strong>{{ $data->bendahara ?? 'Belum Diisi' }}</strong></h2>  
            </div>
            <br />

            <div class="">
              <!-- Tombol Edit -->
              <button class="btn btn-primary" wire:click="openModal">Perbaharui Data Pengurus</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <!-- Modal Edit -->
    <div wire:ignore.self class="modal fade" id="PengurusModal" tabindex="-1" role="dialog" aria-labelledby="iuranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iuranModalLabel">Form Pengurus STT</h5>
                <button type="button" class="close" wire:click="$emit('closeModal')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Iuran -->
                <div class="form-group">
                    <label for="perihal">Nama Ketua STT</label>
                    <input type="text" id="ketua" class="form-control" wire:model="ketua">
                    @error('ketua') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="jumlah">Nama Sekretaris STT</label>
                    <input type="text" id="sekretaris" class="form-control" wire:model="sekretaris">
                    @error('sekretaris') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="jumlah">Nama Bendahara STT</label>
                    <input type="text" id="bendahara" class="form-control" wire:model="bendahara">
                    @error('bendahara') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary" wire:click="store">Simpan</button>
            </div>
        </div>
    </div>
</div>


</div>
