@if($editKas)
<form wire:submit.prevent="update">
@else
<form wire:submit.prevent="store">
@endif
                    @csrf
                    Kode Kas Masuk
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='text' class="form-control" wire:model="kodekas" readonly>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-ok"></span>
                            </span>
                        </div>
                    </div>

                    Jenis KAS
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='text' class="form-control" wire:model="jeniskas" readonly>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-ok"></span>
                            </span>
                        </div>
                    </div>

                    Tanggal KAS Masuk
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
                    @if($editKas)
                        <button type="submit" wire:click="focus" wire:keydown.enter="focus" class="btn btn-success">Update</button>
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-danger">Batal</button>
                    @else
                        <button type="submit" class="btn btn-success">Tambah</button>
                    @endif
                </form>