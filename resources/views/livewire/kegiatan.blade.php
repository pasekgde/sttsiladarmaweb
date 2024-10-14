<div>

    <div class="col-md-3 col-sm-3  ">
        <div class="x_panel">
            <div class="x_title">

                <h2>Buat Baru Data kas</h2>
            
            <div class="clearfix"></div>
            @include('livewire.createkegiatan')
        </div>
    </div>
</div>

    <div class="col-md-9 col-sm-9  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Data Kegiatan</h2>
                    
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
                                <input type="text" wire:model="searchTerm" class="form-control" placeholder="Search for...">
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
                                            <th scope="col">Kode Kegiatan</th>
                                            <th scope="col">Tgl Pembuatan</th>
                                            <th scope="col">Nama Kegiatan</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datakegiatan as $index => $kegiatan)
                                        <tr>
                                            <td style="width:2%">{{$datakegiatan->firstItem() + $index}}</td>
                                            <td>{{$kegiatan->kodekegiatan}}</td>
                                            <td>{{$kegiatan->tglpembuatan}}</td>
                                            <td>{{$kegiatan->namakegiatan}}</td>
                                            <td>{{$kegiatan->deskripsi}}</td>
                                            <td>{{$kegiatan->user}}</td>
                                            <td style="text-align:center">
                                                <a href="#" wire:click="edit({{$kegiatan->id}})" style="color:blue"><i class="fa fa-pencil"></i> Edit </a>&nbsp&nbsp&nbsp
                                                <a href="#" wire:click.prevent="destroypesan({{$kegiatan->id}})" data-name="" data-id="" style="color:red"><i class="fa fa-trash-o"></i> Delete </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="float-left">
                                    <p>{{ $datakegiatan->total() }} Item Rows</p>
                                </div>
                                <div class="float-right">
                                    {{ $datakegiatan->links() }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
</div>




        
