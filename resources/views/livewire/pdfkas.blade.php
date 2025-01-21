<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="/Asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/Asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/Asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="/Asset/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Theme Style -->
    <link href="/Asset/build/css/custom.min.css" rel="stylesheet">
    <title>Laporan KAS IN OUT</title>

<body>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            border-color: #ccc;
            width: 100%;
        }

        .tg td {
            font-family: Arial;
            font-size: 12px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #fff;
        }

        .tg th {
            font-family: Arial;
            font-size: 14px;
            font-weight: normal;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #f0f0f0;
        }

        .tg .tg-3wr7 {
            font-weight: bold;
            font-size: 12px;
            font-family: "Arial", Helvetica, sans-serif !important;
            ;
            text-align: center
        }

        .tg .tg-ti5e {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;
            ;
            text-align: center
        }

        .tg .tg-rv4w {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;
        }
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            font-size: 14px; /* Smaller font size */
        }

        .header {
            text-align: center;
            padding: 20px;
            border-bottom: 3px solid #000;
        }

        .header img {
            width: 120px;
        }

        .header h1 {
            font-size: 24px; /* Smaller and more elegant */
            margin: 5px 0;
        }

        .header h2,
        .header h3 {
            margin: 2px 0;
            font-weight: normal;
            font-size: 16px; /* Adjusted size */
        }

        .content {
            padding: 20px;
        }

        .summary {
            margin-bottom: 20px;
        }

        .summary table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .summary table th,
        .summary table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 14px; /* Smaller font */
        }

        .summary table th {
            background-color: #f9f9f9;
        }

        .member-table {
            margin-top: 20px;
        }

        /* Bootstrap Table Styling */
        .table th, .table td {
            font-size: 14px; /* Smaller font size */
        }

        /* Underline signature */
        .signature {
            display: block;
            margin-top: 60px;
            padding-top: 5px;
            text-decoration: underline;
        }
    </style>

        <table width="100%">
            <tr>
                <td> <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $logoPath))) }}" width="140px"> </td>
                <td><td>
                <td class="tengah">
                    <div class="caption" style="font-family:Arial; font-size:40px; font-weight:bold;"><span>STT SILA DHARMA</span></div>
                    <div class="end"></div>
                    
                    <b style="font-family:Arial; font-size:25px; font-weight:bold;">Lingk./Br. Cempaga, Kelurahan Cempaga, Kecamatan Bangli-Bali</b>
                    <div class="end"></div>

                    <div class="caption" style="font-family:Arial; font-size:15px"><span>Kode Pos : 80612</span></div>
                    <div class="end"></div>
                </td>
            </tr>
        </table>

        <div class="row">
            <div style="background-color: black; height: 3px; width: 100%;"></div>
        </div>

        <center>
            <h2>Data Laporan KAS STT</h2>
            <h3>{{$tipekas}}</h3>
        </center>

        <table>
            <tr>
                <td>Kas Masuk</td>
                <td>:</td>
                <td>
                 {{ $summasuk }}
                </td>
            </tr>

            <tr>
                <td>Kas keluar</td>
                <td>:</td>
                <td>
                {{ $sumkeluar }}
                </td>
            </tr>

            <tr>
                <td>Saldo</td>
                <td>:</td>
                <td>
                {{ $saldo }}
                </td>
            </tr>
        </table>
        <br>
        <table class="tg" width="100%">
            <tr>
            <th class="tg-3wr7" scope="col" style="text-align: center;">No<br></th>
            <th class="tg-3wr7" scope="col" style="text-align: center;">Jenis Kas<br></th>
            <th class="tg-3wr7" scope="col" style="text-align: center;">Tanggal<br></th>
            <th class="tg-3wr7" scope="col" style="text-align: center;">Keterangan<br></th>
            <th class="tg-3wr7" scope="col" style="text-align: center;">Qty<br></th>
            <th class="tg-3wr7" scope="col" style="text-align: center;">Harga<br></th>
            <th class="tg-3wr7" scope="col" style="text-align: center;">Total<br></th>
            <th class="tg-3wr7" scope="col" style="text-align: center;">Operator<br></th>
            </tr>
            <?php $no = 0;?>
            @foreach($data as $index => $kas)
            <?php $no++ ;?>
            <tr>
            <td style="width:2%">{{$no}}</td>
            <td class="tg-rv4w" style="text-align: center;">{{$kas->jeniskas}}</td>
            <td class="tg-rv4w" style="text-align: center;">{{$kas->tglkas}}</td>
            <td class="tg-rv4w" >{{$kas->keterangan}}</td>
            <td class="tg-rv4w" style="text-align: center;">{{$kas->qty}}</td>
            <td class="tg-rv4w">{{currency_IDR($kas->harga)}}</td>
            <td class="tg-rv4w">{{currency_IDR($kas->jumlah)}}</td>
            <td class="tg-rv4w" style="text-align: center;">{{$kas->user}}</td>
            </tr>
            @endforeach

        </table>
        <table style="width: 100%; margin-top: 50px; text-align: center; border-collapse: collapse;">
            <tr>
                <!-- Kolom Bendahara -->
                <td style="width: 33%; text-align: center;">
                    <p>Bendahara</p>
                    <strong>TTD</strong> <!-- Menambahkan TTD di bawah tanda tangan -->
                    <span class="signature">{{ $pengurus->bendahara ?? '' }}</span><br>
                </td>

                <!-- Kolom kosong untuk memisahkan -->
                <td style="width: 33%;"></td>

                <!-- Kolom Sekretaris -->
                <td style="width: 33%; text-align: center;">
                    <p>Sekretaris</p>
                    <strong>TTD</strong> <!-- Menambahkan TTD di bawah tanda tangan -->
                    <span class="signature">{{ $pengurus->sekretaris ?? '' }}</span><br>
                </td>
            </tr>
            <tr>
                <!-- Ketua di tengah bawah -->
                <td colspan="3" style="padding-top: 50px;">
                    <p>Mengetahui</p>
                    <p>Ketua STT</p>
                    <strong>TTD</strong> <!-- Menambahkan TTD di bawah tanda tangan -->
                    <span class="signature">{{ $pengurus->ketua ?? '' }}</span><br>
                </td>
            </tr>
        </table>

    </body>
</head>
 <!-- jQuery -->
  <script src="/Asset/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="/Asset/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="/Asset/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/Asset/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="/Asset/build/js/custom.min.js"></script>

</html>