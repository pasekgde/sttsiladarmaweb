<div>

<div class="container mt-4">
    <div class="row">
        <!-- Kotak untuk Data Absensi -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Absensi</h5>
                </div>
                <div class="card-body">
         

                        <button type="submit" wire:click.prevent="truncateabsensi" class="btn btn-danger btn-block">Truncate Data Absensi</button>

                </div>
            </div>
        </div>

        <!-- Kotak untuk Data Kegiatan -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Kegiatan</h5>
                </div>
                <div class="card-body">
        

                        <button type="submit" wire:click.prevent="truncatekegiatan" class="btn btn-danger btn-block">Truncate Data Kegiatan</button>

                </div>
            </div>
        </div>

        <!-- Kotak untuk Data Kas -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Kas</h5>
                </div>
                <div class="card-body">
        

                        <button type="submit" wire:click.prevent="truncatekas" class="btn btn-danger btn-block">Truncate Data Kas</button>

                </div>
            </div>
        </div>

        <!-- Kotak untuk Data Anggota -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Anggota</h5>
                </div>
                <div class="card-body">
             

                        <button type="submit" wire:click.prevent="truncateanggota" class="btn btn-danger btn-block">Truncate Data Anggota</button>
                </div>
            </div>
        </div>

        <!-- Kotak untuk Data Iuran -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Iuran</h5>
                </div>
                <div class="card-body">
             

                        <button type="submit" wire:click.prevent="truncatebayariuran" class="btn btn-danger btn-block">Truncate Data Iuran</button>

                </div>
            </div>
        </div>

        <!-- Kotak untuk Data Iuran -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Penekelan</h5>
                </div>
                <div class="card-body">
             

                        <button type="submit" wire:click.prevent="truncatepenekelan" class="btn btn-danger btn-block">Truncate Data Penekelan</button>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Pengajuan</h5>
                </div>
                <div class="card-body">
     

                        <button type="submit" wire:click.prevent="truncateoutstt" class="btn btn-danger btn-block">Truncate Data Pengajuan</button>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Alumni</h5>
                </div>
                <div class="card-body">


                        <button type="submit" wire:click.prevent="truncatealumni" class="btn btn-danger btn-block">Truncate Data Alumni</button>

                </div>
            </div>
        </div>
    </div>
</div>

</div>
