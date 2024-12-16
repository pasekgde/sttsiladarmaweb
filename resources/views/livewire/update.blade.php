<form wire:submit.prevent="update">
             @csrf
            Kode Kas Keluar
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' wire:model="kodekas" class="form-control" id="#" name="kodekas" readonly>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-ok"></span>
                    </span>
                </div>
            </div>

            Jenis KAS
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' wire:model="jeniskas" class="form-control" name="jeniskas" readonly>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-ok"></span>
                    </span>
                </div>
            </div>

            Tanggal KAS Keluar
            <div class="form-group">
                <div class='input-group date'>
                    <input type='date' wire:model="tglkas" class="form-control @error('tglkas') is-invalid @enderror" name="tglkas" >
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    
                </div>
            </div>

            Keterangan
            <div class="form-group">
                <div class='input-group date'>
                    <textarea wire:model="keterangan" class="form-control @error('keterangan') is-invalid @enderror text-lowercase" name="keterangan" id="keterangan" autofocus></textarea>
                </div>
            </div>
            

            QTY
            <div class="form-group">
                <div class='input-group date'>
                <input type="number" wire:model="qty" wire:keyup.debounce.150ms="keyupjumlah" class="form-control @error('qty') is-invalid @enderror">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-asterisk"></span>
                    </span>
                </div>
            </div>

            Harga
            <div class="form-group">
                <div class='input-group date'>
                    <input type="text" wire:model="harga" wire:keyup.debounce.150ms="keyupjumlah" class="form-control @error('harga') is-invalid @enderror" type-currency="IDR">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-usd"></span>
                    </span>
                </div>
            </div>

            Total
            <div class="form-group">
                <div class='input-group date'>
                    <input type="text" wire:model="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                    value="{{ $jumlah }}" readonly>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-usd"></span>
                    </span>
                </div>
            </div>
                
            </div>
            <button type="submit" wire:click="focus" wire:keydown.enter="focus" class="btn btn-success">Update</button>
            <button type="button" wire:click.prevent="cancel()" class="btn btn-danger">Batal</button>
        </form>