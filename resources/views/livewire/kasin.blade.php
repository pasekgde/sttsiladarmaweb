<div>
    <div class="col-md-3 col-sm-3  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Asukang Data Kas Masuk</h2>
                <div class="clearfix"></div>
            </div>
            @include('livewire.createkasin')
        </div>
    </div>

        <div class="col-md-9 col-sm-9  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Kas Masuk : &nbsp<h2 class="font-weight-bold count red">  {{$sumkasmasuk}}</h2></h2>
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
                        <table class="table table-striped table-bordered table-responsive table-hover" style="width:100%">
                            <thead>
                                <tr style="text-align: center">
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Kas</th>
                                    <th scope="col">Tgl Kas</th>
                                    <th scope="col">Jenis kas</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kasin as $index => $kasmasuk)
                                <tr>
                                    <td style="width:2%">{{$kasin->firstItem() + $index}}</td>
                                    <td>{{$kasmasuk->kodekas}}</td>
                                    <td>{{$kasmasuk->tglkas}}</td>
                                    <td>{{$kasmasuk->jeniskas}}</td>
                                    <td>{{$kasmasuk->keterangan}}</td>
                                    <td>{{ currency_IDR($kasmasuk->jumlah) }}</td>
                                    <td>{{$kasmasuk->user}}</td>
                                    <td style="text-align:center">
                                        <a href="#" wire:click="edit({{$kasmasuk->id}})" style="color:blue"><i class="fa fa-pencil"></i>Edit </a>&nbsp&nbsp&nbsp
                                        <a href="#" wire:click.prevent="destroypesan({{$kasmasuk->id}})" class="delete" style="color:red"><i class="fa fa-trash-o"></i>Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="float-left">
                                    <p>{{ $kasin->total() }} Item Rows</p>
                                </div>
                                <div class="float-right">
                                    {{ $kasin->links() }}
                                </div>
                </div>
            </div>
        </div>
    </div>
</div>