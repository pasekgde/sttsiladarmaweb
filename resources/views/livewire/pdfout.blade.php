<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Iuran</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            padding: 10px;
            border-bottom: 3px solid #000;
        }

        .header img {
            width: 120px;
        }

        .header h1 {
            font-size: 20px; /* Smaller and more elegant */
            margin: 5px 0;
        }

        .header h2,
        .header h3 {
            margin: 2px 0;
            font-weight: normal;
            font-size: 14px; /* Adjusted size */
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
            margin-bottom: 10px;
        }

        .summary table th,
        .summary table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 12px; /* Smaller font */
        }

        .summary table th {
            background-color: #f9f9f9;
        }

        .member-table {
            margin-top: 10px;
        }

        /* Bootstrap Table Styling */
        .table th, .table td {
            font-size: 12px; /* Smaller font size */
        }

        /* Underline signature */
        .signature {
            display: block;
            margin-top: 40px;
            padding-top: 5px;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $data->logo))) }}" alt="Logo">
        <h1>STT SILA DHARMA</h1>
        <h2>Lingk./Br. Cempaga, Kelurahan Cempaga, Kecamatan Bangli Bali</h2>
        <h3>No. Tlp. 089603158518</h3>
    </div>

    <div class="content">
        <h4 class="text-center">Surat Tunggakan</h4>

        <div class="summary">
            <table class="table table-bordered">
                <tr>
                    <th class="table-primary">Nama Anggota</th>
                    <td>{{$anggota->nama}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Tempek</th>
                    <td>{{$anggota->tempek}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Tanggal Lahir</th>
                    <td>{{$anggota->tgllahir}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Status</th>
                    <td>{{$anggota->status}}</td>
                </tr>
                @if($denda && $denda->isNotEmpty())
                <tr>
                    <th class="table-primary">Total Denda</th>
                    <td>Rp {{ number_format($sumdenda, 0, ',', '.') }}</td>
                </tr>
                @endif
                @if($iuran && $iuran->isNotEmpty())
                <tr>
                    <th class="table-primary">Total Iuran</th>
                    <td>Rp {{ number_format($sumiuran, 0, ',', '.') }}</td>
                </tr>
                @endif
            </table>
        </div>

        <!-- Tabel Data Tunggakan Iuran -->
        @if($iuran && $iuran->isNotEmpty())
        <div class="member-table">
            <h4>Data Tunggakan Iuran</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="table-primary">No</th>
                        <th class="table-primary">Nama Iuran</th>
                        <th class="table-primary">Jumlah</th>
                        <th class="table-primary">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($iuran as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->perihal }}</td>
                        <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $item->statusbayar }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <h4>Tidak Ada Tunggakan Iuran/LUNAS</h4>
        @endif

        <!-- Tabel Data Tunggakan Denda -->
        @if($denda && $denda->isNotEmpty())
        <div class="member-table">
            <h4>Data Tunggakan Denda</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="table-primary">Nomor</th>
                        <th class="table-primary">Nama Kegiatan</th>
                        <th class="table-primary">Jumlah</th>
                        <th class="table-primary">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($denda as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->nama_kegiatan }}</td>
                        <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <h4>Tidak Ada Denda / LUNAS</h4>
        @endif

        <table style="width: 100%; margin-top: 50px; text-align: center; border-collapse: collapse;">
            <tr>
                <!-- Kolom Bendahara -->
                <td style="width: 33%; text-align: center;">
                    <p>Bendahara</p>
                    <span class="signature">{{ $pengurus->bendahara ?? '' }}</span><br>
                </td>

                <!-- Kolom kosong untuk memisahkan -->
                <td style="width: 33%;"></td>

                <!-- Kolom Sekretaris -->
                <td style="width: 33%; text-align: center;">
                    <p>Sekretaris</p>
                    <span class="signature">{{ $pengurus->sekretaris ?? '' }}</span><br>
                </td>
            </tr>
            <tr>
                <!-- Ketua di tengah bawah -->
                <td colspan="3" style="padding-top: 50px;">
                    <p>Mengetahui</p>
                    <p>Ketua STT</p>
                    <span class="signature">{{ $pengurus->ketua ?? '' }}</span><br>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
