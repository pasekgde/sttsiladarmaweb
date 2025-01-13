<div>
  <style>
    .product-image img {
        max-width: 100%;  /* Lebar maksimum 100px */
        height: auto;      /* Menjaga rasio gambar tetap */
        object-fit: contain; /* Menjaga gambar tidak terdistorsi */
    }

    </style>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Data Informasi Profil Sistem</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="col-md-5 col-sm-5 ">
            <div class="product-image">
            @if($data && $data->logo)
                  <img src="{{ Storage::url($data->logo) }}" alt="Logo">
              @else
                  <span>No Logo</span>
              @endif
            </div>
          </div>

          <div class="col-md-7 col-sm-7 " style="border:0px solid #e5e5e5;">

            <h3 class="prod_title">Informasi Profil Sistem</h3>

            <div class="">
              <h2>Nama Sistem : <strong>{{ $data->nama_sistem ?? 'Belum Diisi' }}</strong></h2>  
            </div>
            <br />

            <div class="">
              <h2>Nama Organisasi : <strong>{{ $data->organisasi ?? 'Belum Diisi' }}</strong></h2>  
            </div>
            <br />

            <div class="">
              <h2>Sub Judul : <strong>{{ $data->subjudul ?? 'Belum Diisi' }}</strong></h2>  
            </div>
            <br />

            <div class="">
              <h2>Deskripsi 1 :</h2>  
                  <div class="product_price">
                      <span class="price-tax"><strong>{{ $data->deskripsi1 ?? 'Belum Diisi' }}</strong></span>
                      <br>
                  </div>
            </div>

            <div class="">
              <h2>Deskripsi 2 :</h2>  
                  <div class="product_price">
                      <span class="price-tax"><strong>{{ $data->deskripsi2 ?? 'Belum Diisi' }}</strong></span>
                      <br>
                  </div>
            </div>

            <div class="">
              <!-- Tombol Edit -->
              <button class="btn btn-primary" wire:click="openModal">Ubdah Data Profil</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Data Informasi Profil Sistem</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="col-md-12 col-sm-12 ">
            <div class="product-image">
            @if($data && $data->background)
                  <img src="{{ Storage::url($data->background) }}" alt="Logo">
              @else
                  <span>No Image</span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal Edit -->
    @if($modalOpen)
      <div class="modal fade show" tabindex="-1" style="display: block;" aria-labelledby="editModalLabel" aria-hidden="false">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Data Sistem</h5>
                      <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <!-- Form Edit -->
                      <div class="row">
                          <!-- Kolom 1 -->
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="name">Nama Sistem</label>
                                  <input type="text" class="form-control @error('newName') is-invalid @enderror" id="name" wire:model="newName">
                              </div>
                              <div class="form-group">
                                  <label for="name">Nama Organisasi</label>
                                  <input type="text" class="form-control @error('newOrganisasi') is-invalid @enderror" id="name" wire:model="newOrganisasi">
                              </div>
                              <div class="form-group">
                                  <label for="subtitle">Sub Judul</label>
                                  <input type="text" class="form-control @error('newSubtitle') is-invalid @enderror" id="subtitle" wire:model="newSubtitle">
                              </div>
                              <div class="form-group">
                                  <label for="description1">Deskripsi 1</label>
                                  <textarea class="form-control @error('newDescription1') is-invalid @enderror" id="description1" wire:model="newDescription1"></textarea>
                              </div>
                              <div class="form-group">
                                  <label for="description2">Deskripsi 2</label>
                                  <textarea class="form-control @error('newDescription2') is-invalid @enderror" id="description2" wire:model="newDescription2"></textarea>
                              </div>
                          </div>

                          <!-- Kolom 2 -->
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="logo">Logo (Upload Image)</label>
                                  <input type="file" class="form-control @error('newLogo') is-invalid @enderror" id="logo" wire:model="newLogo">
                                  @if($newLogo && is_object($newLogo)) 
                                      <!-- Preview of the new uploaded logo (using temporaryUrl()) -->
                                      <p>Preview Logo Baru:</p>
                                      <img src="{{ $newLogo->temporaryUrl() }}" width="100">
                                  @elseif($this->data && $this->data->logo)
                                      <!-- Display the existing logo if it exists -->
                                      <p>Logo yang ada:</p>
                                      <img src="{{ Storage::url($this->data->logo) }}" width="100">
                                  @else
                                      <span>No Logo</span>
                                  @endif
                              </div>
                              <div class="form-group">
                                  <label for="background">Background</label>
                                  <input type="file" class="form-control @error('newBackground') is-invalid @enderror" id="background" wire:model="newBackground">
                                  @if($newBackground && is_object($newBackground)) 
                                      <!-- Preview of the new uploaded background (using temporaryUrl()) -->
                                      <p>Preview Background Baru:</p>
                                      <img src="{{ $newBackground->temporaryUrl() }}" width="100">
                                  @elseif($this->data && $this->data->background)
                                      <!-- Display the existing background if it exists -->
                                      <p>Background yang ada:</p>
                                      <img src="{{ Storage::url($this->data->background) }}" width="100">
                                  @else
                                      <span>No Image</span>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                      <button type="button" class="btn btn-primary" wire:click="save">Simpan</button>
                  </div>
              </div>
          </div>
      </div>
  @endif

</div>
