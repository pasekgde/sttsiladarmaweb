@if($formedit)
<form wire:submit.prevent="update">
@else
<form wire:submit.prevent="store">
@endif
                    @csrf
                    Kode Kegiatan
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='text' wire:model="kodekegiatan" class="form-control"  readonly>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-ok"></span>
                            </span>
                        </div>
                    </div>

                    Tanggal Pembuatan
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='text' wire:model="tglpembuatan" id="tglpembuatan"
                                class="form-control @error('tglpembuatan') is-invalid @enderror">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    Nama Kegiatan
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='text' wire:model="namakegiatan" id="namakegiatan"
                                class="form-control @error('namakegiatan') is-invalid @enderror">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    Deskripsi
                    <div class="form-group">
                        <div class='input-group date'>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                wire:model="deskripsi"></textarea>
                        </div>
                    </div>

                    <div>
                        <label for="multiple-select">Siapa yang boleh mengakses</label>
                        <select id="multiple-select" multiple wire:model="selectedOptions" class="form-control">
                            @foreach ($users as $option)
                                <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                            @endforeach
                        </select>

                        <h5>Yang dapat mengakses :</h5>
                        <ul>
                            @foreach ($selectedOptions as $optionId)
                                <li>{{ $users[array_search($optionId, array_column($users, 'id'))]['name'] }}</li>
                            @endforeach
                            
                        </ul>
                    </div>


                        @if($formedit)
                            <button type="submit" wire:click="focus" wire:keydown.enter="focus" class="btn btn-success">Update</button>
                            <button type="button" wire:click.prevent="cancel()" class="btn btn-danger">Batal</button>
                        @else
                            <button type="submit" class="btn btn-success">Tambah</button>
                        
                        @endif

                </form>