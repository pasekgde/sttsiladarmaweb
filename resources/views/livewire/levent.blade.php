<div>
    <style>
        .loading-container {
            position: fixed;  /* Membuat posisi tetap di layar */
            top: 0;
            left: 0;
            width: 100%;  /* Mengambil lebar seluruh layar */
            height: 100%;  /* Mengambil tinggi seluruh layar */
            display: flex;  /* Menggunakan flexbox */
            justify-content: center;  /* Menempatkan spinner secara horizontal di tengah */
            align-items: center;  /* Menempatkan spinner secara vertikal di tengah */
            background-color: rgba(0, 0, 0, 0.5);  /* Memberikan latar belakang transparan */
            z-index: 9999;  /* Memastikan spinner muncul di atas elemen lainnya */
            flex-direction: column;  /* Menyusun spinner dan teks secara vertikal */
        }

        /* Styling untuk teks loading */
        .loading-text {
            color: white;  /* Warna teks putih */
            font-size: 18px;  /* Ukuran teks */
            margin-top: 10px;  /* Memberikan jarak antara spinner dan teks */
            font-weight: bold;  /* Menebalkan teks */
        }
    </style>
    
    <div wire:loading wire:target="printkas">
        <div class="loading-container">
            <div class="spinner-border text-light" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="loading-text">
                Sedang Mendownload Data...
            </div>
        </div>
    </div>

    <div class="col-md-9 col-sm-9  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Laporan kegiatan &nbsp</h2><h2 class="font-weight-bold count red">{{$namaevent->namakegiatan}}</h2>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-3">
                <label for="fullname">Tanggal Awal * :</label>
                <input type="date" class="form-control " data-provide="" wire:model="tglawal">
            </div>
            <div class="col-md-3">
                <label for="fullname">Tanggal Akhir * :</label>
                <input type="date" class="form-control " data-provide="" wire:model="tglakhir">
            </div>
            <div class="col-md-3">
                <label for="heard">Jenis Kas *:</label>
                <select id="heard" class="form-control" wire:model="tipekas">
                    <option value="">Semua</option>
                    <option value="Masuk">Masuk</option>
                    <option value="Keluar">Keluar</option>
                </select>
            </div>
            <div class="form-group row col-md-3">
				<div class="col-md-12">
                    <label for="heard">&nbsp</label><br>
					<button type="button" wire:click="semua" class="btn btn-primary">Reset</button>
					<button class="btn btn-warning" wire:click="printkas">Print</button>
				</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-3  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Saldo Kas : &nbsp<h2 class="font-weight-bold count red">{{$saldo}}</h2></h2>
                <div class="clearfix"></div>
            </div>
            <form class="form-horizontal">

                <div class="form-group">
                    <label class="col-md-4 col-sm-4" for="first-name">Kas Masuk : <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 ">
                        <input type="text" wire:model="sumkasmasuk" required="required" data-provide="datepicker" class="form-control datepicker">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 col-sm-4" for="last-name">Kas Keluar : <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 ">
                        <input type="text" wire:model="sumkaskeluar" required="required" data-provide="datepicker" class="form-control datepicker">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="form-group x_panel">
        <select id="cars" class="form-control col-md-1" wire:model="perpage">
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
        <table class="table table-striped table-bordered table-responsive table-hover" style="width:100%">
            <thead class="table-dark text-center">
                <tr style="text-align: center">
                    <th scope="col" sty>No</th>
                    <th scope="col">Tgl Kas</th>
                    <th scope="col">Jenis kas</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">User</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datakas as $index => $kas)
                <tr>
                    <td style="width:2%">{{$datakas->firstItem() + $index}}</td>
                    <td>{{$kas->tglkas}}</td>
                    <td>{{$kas->jeniskas}}</td>
                    <td>{{$kas->keterangan}}</td>
                    @if ($kas->qty == '' || $kas->qty == 0)
                        <td>-</td>
                    @else
                        <td>{{$kas->qty}}</td>
                    @endif
                    <td>{{ currency_IDR($kas->harga)}}</td>
                    <td>{{ currency_IDR($kas->jumlah) }}</td>
                    <td>{{$kas->user}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="float-left">
        {{ $datakas->total() }} Item Rows
        </div>
        <div class="float-right">
        {{ $datakas->links() }}
        </div>
    </div>
</div>


        
