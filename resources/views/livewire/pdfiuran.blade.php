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
</head>

<body>
    <div class="header">
        <img src="https://i.ibb.co.com/bNVPrX5/logo.png" alt="Logo">
        <h1>STT SILA DHARMA</h1>
        <h2>Lingk./Br. Cempaga, Kelurahan Cempaga, Kecamatan Bangli Bali</h2>
        <h3>No. Tlp. 089603158518</h3>
    </div>

    <div class="content">
        <h3 class="text-center">Data Laporan Iuran STT</h3>

        <div class="summary">
            <table class="table table-bordered">
                <tr>
                    <th class="table-primary">Nama Iuran</th>
                    <td>{{$iuran->perihal}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Jumlah Iuran</th>
                    <td>{{ number_format($iuran->jumlah, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Iuran</th>
                    <td>{{ number_format($iuran->total_iuran, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Anggota</th>
                    <td>{{$iuran->total_anggota}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Sudah Bayar</th>
                    <td>{{$iuran->total_yangsudahbayar}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Belum Bayar</th>
                    <td>{{$iuran->total_yangbelumbayar}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Bayar</th>
                    <td>{{ number_format($iuran->total_bayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="table-primary">Status</th>
                    <td>{{$iuran->status}}</td>
                </tr>
            </table>
        </div>

        <div class="member-table">
            <h4>Daftar Anggota</h4>
            <table class="table table-bordered">
    <thead>
        <tr>
            <th class="table-primary">No</th>
            <th class="table-primary">Nama Anggota</th>
            <th class="table-primary">Jumlah Bayar</th>
            <th class="table-primary">Tanggal Bayar</th>
            <th class="table-primary">Status Bayar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bayariuran as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ ucwords(strtolower($anggota[$key]->nama)) ?? 'N/A' }}</td>
                <td>Rp {{ number_format($item->jumlahbayar, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggalbayar)->format('d-m-Y') }}</td>  <!-- Format date without time -->
                <td>{{ $item->statusbayar }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

        </div>

        <table style="width: 100%; margin-top: 50px; text-align: center; border-collapse: collapse;">
            <tr>
                <!-- Kolom Bendahara -->
                <td style="width: 33%; text-align: center;">
                    <p>Bendahara</p>
                    <span class="signature">I Putu Yuda Permadi</span>
                </td>
            
                <!-- Kolom kosong untuk memisahkan -->
                <td style="width: 33%;"></td>
            
                <!-- Kolom Sekretaris -->
                <td style="width: 33%; text-align: center;">
                    <p>Sekretaris</p>
                    <span class="signature">Ni Kadek Ima Irmayani, S.Pd</span>
                </td>
            </tr>
            <tr>
                <!-- Ketua di tengah bawah -->
                <td colspan="3" style="padding-top: 50px;">
                    <p>Mengetahui</p>
                    <p>Ketua STT Sila Dharma</p>
                    <span class="signature">Gde Gung Prabawa, S.Pd</span>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
