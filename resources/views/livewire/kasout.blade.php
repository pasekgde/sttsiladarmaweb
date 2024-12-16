<div>

    <div class="col-md-3 col-sm-3  ">
        <div class="x_panel">
            <div class="x_title">

                <h2>Asukang Data Kas Keluar</h2>
            
            <div class="clearfix"></div>
            @if($editKas)
                @include('livewire.update')
            @else
                @include('livewire.create')
            @endif
        </div>
    </div>

    <div class="col-md-9 col-sm-9  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Data Kas Keluar : &nbsp<h2 class="font-weight-bold count red">  {{$sumkaskeluar}}</h2></h2>
                    
                        <div class="clearfix"></div>
                    </div>

                    <div class="">
                        <select id="cars" class="form-control col-sm-1" wire:model="perpage">
                            <option value="10">10</option>
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
                                <table id="#" class="table table-striped table-bordered table-responsive table-hover" style="width:100%">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Kas</th>
                                            <th scope="col">Tgl Kas</th>
                                            <th scope="col">Jenis kas</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">QTY</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kasout as $index => $kaskeluar)
                                        <tr>
                                            <td style="width:2%">{{$kasout->firstItem() + $index}}</td>
                                            <td>{{$kaskeluar->kodekas}}</td>
                                            <td>{{$kaskeluar->tglkas}}</td>
                                            <td>{{$kaskeluar->jeniskas}}</td>
                                            <td>{{$kaskeluar->keterangan}}</td>
                                            @if($kaskeluar->qty == "")
                                                <td>-</td>
                                            @else
                                            <td>{{$kaskeluar->qty}}</td>
                                            @endif
                                            <td>{{ $kaskeluar->harga }}</td>
                                            <td>{{ $kaskeluar->jumlah }}</td>
                                            <td>{{$kaskeluar->user}}</td>
                                            <td style="text-align:center">
                                                <a href="#" wire:click="edit({{$kaskeluar->id}})" style="color:blue"><i class="fa fa-pencil"></i> Edit </a>&nbsp&nbsp&nbsp
                                                <a href="#" wire:click.prevent="destroypesan({{$kaskeluar->id}})" data-name="" data-id="" style="color:red"><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="float-left">
                                    <p>{{ $kasout->total() }} Item Rows</p>
                                </div>
                                <div class="float-right">
                                    {{ $kasout->links() }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
</div>




        
