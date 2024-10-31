<div>
    
    <div class="col-md-3 col-sm-3  ">
        <div class="x_panel">
            <div class="x_title">

                <h2>Buat Baru Data Rincian Kegiatan</h2>
            
            <div class="clearfix"></div>
            @include('livewire.crudkegiatan')
        </div>
        Kas Masuk :
        <div class="form-group">
            <div class='input-group date'>
                <input type="text"wire:model="sumkasmasuk" class="form-control" type-currency="IDR" readonly>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-usd"></span>
                </span>
            </div>
        </div>
        Kas Keluar :
        <div class="form-group">
            <div class='input-group date'>
                <input type="text"wire:model="sumkaskeluar" class="form-control" type-currency="IDR" readonly>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-usd"></span>
                </span>
            </div>
        </div>
        Saldo :
        <div class="form-group">
            <div class='input-group date'>
                <input type="text"wire:model="saldo" class="form-control red" type-currency="IDR" readonly>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-usd"></span>
                </span>
            </div>
        </div>
    </div>
</div>

    <div class="col-md-9 col-sm-9  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Data Rincian Kegiatan</h2>
                    
                        <div class="clearfix"></div>
                    </div>

                    <div class="">
                        <select id="cars" class="form-control col-sm-1" wire:model="perpage">
                            <option value="15">15</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="form-group pull-right top_search float-right">
                            <div class="input-group ">
                                <input type="text" wire:model="search" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                        <!-- <a href="createkasmasuk" class="btn btn-success"><i class="fa fa-plus-square">  Tambah Data</i></a> -->
                                <table id="#" class="warnai table table-striped table-bordered table-responsive table-hover" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal KAS</th>
                                            <th scope="col">Jenis KAS</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datakegiatan as $index => $ev)
                                        <tr>
                                            <td style="width:2%">{{$datakegiatan->firstItem() + $index}}</td>
                                            <td>{{$ev->tglkas}}</td>
                                            <td>{{$ev->jeniskas}}</td>
                                            <td>{{$ev->keterangan}}</td>
                                            <td>{{$ev->qty}}</td>
                                            <td>{{currency_IDR($ev->harga)}}</td>
                                            <td>{{currency_IDR($ev->jumlah)}}</td>
                                            <td>{{$ev->user}}</td>
                                            <td style="text-align:center">
                                                <a href="#" wire:click="edit({{$ev->id}})" style="color:blue"><i class="fa fa-pencil"></i> Edit </a>&nbsp&nbsp&nbsp
                                                <a href="#" wire:click.prevent="destroypesan({{$ev->id}})" data-name="" data-id="" style="color:red"><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="float-left">
                                    <p> {{ $datakegiatan->total() }} Item Rows</p>
                                </div>
                                <div class="float-right">
                                    {{ $datakegiatan->links() }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
</div>




        
