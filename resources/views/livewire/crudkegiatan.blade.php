@if($formedit)
<form wire:submit.prevent="update">
@else
<form wire:submit.prevent="store">
@endif
                    @csrf
                    Kode Event
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='text' class="form-control" wire:model="kodeevent" readonly>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-ok"></span>
                            </span>
                        </div>
                    </div>

                    Nama Kegiatan
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='hidden' class="form-control" wire:model="kodekegiatan" readonly>
                            <input type='text' class="form-control" wire:model="namakegiatan" readonly>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-ok"></span>
                            </span>
                        </div>
                    </div>

                    Jenis KAS
                    <div class="form-group">
                        <div class='input-group date'>
                            <select class="form-control  @error('jeniskas') is-invalid @enderror"" wire:model="jeniskas">
                                <option value="">--Pilih Malu--</option>
                                <option value="Masuk">Masuk</option>
                                <option value="Keluar">Keluar</option>
                            </select>
                        </div>
                    </div>

                    Tanggal KAS
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='date' wire:model="tglkas" 
                                class="form-control @error('tglkas') is-invalid @enderror">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    Keterangan
                    <div class="form-group">
                        <div class='input-group date'>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                wire:model="keterangan" id="keterangan" autofocus></textarea>
                        </div>
                    </div>

                    QTY
                    <div class="form-group">
                        <div class='input-group'>
                            <input type="number" wire:model="qty" wire:keyup.debounce.150ms="keyupjumlah"
                                class="form-control @error('qty') is-invalid @enderror">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-asterisk"></span>
                            </span>
                        </div>
                    </div>

                    Harga
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type="text" wire:model="harga" wire:keyup.debounce.150ms="keyupjumlah"
                                class="form-control @error('harga') is-invalid @enderror" type-currency="IDR">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-usd"></span>
                            </span>
                        </div>
                    </div>

                    Total
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type="text" wire:model="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                                type-currency="IDR">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-usd"></span>
                            </span>
                        </div>
                    </div>
                    @if($formedit)
                        <button type="submit" wire:click="focus" wire:keydown.enter="focus" class="btn btn-success">Update</button>
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-danger">Batal</button>
                    @else
                        <button type="submit" class="btn btn-success">Tambah</button>
                    @endif
                </form>
                