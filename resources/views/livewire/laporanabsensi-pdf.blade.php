<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi - {{ $tabelkegiatan->nama_kegiatan }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop {
            font-size: 20px;
            font-weight: bold;
        }
        .subkop {
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 14px;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="kop">PRESENSI ST SILA DARMA</div>
        <div class="subkop">
            Lingk./Br, Cempaga, Kel. Cempaga, Kec. Bangli Bali
        </div>
    </div>

    <h3 style="text-align:center;">LAPORAN ABSENSI Kegiatan: {{ $tabelkegiatan->nama_kegiatan }}</h3>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Anggota</th>
                <th>Status</th>
                <th>Presensi</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detailPresensi as $key => $presensi)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $presensi['nama_anggota'] }}</td>
                    <td>{{ $presensi['status'] }}</td>
                    <td>{{ $presensi['presensi'] }}</td>
                    <td>{{ $presensi['denda'] != 0 ? currency_IDR($presensi['denda']) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <p>Ketua STT</p>
        <p><strong>Gde Gung Prabawa</strong></p>
        <p>_______________________</p>
        <p>Sekretaris:</p>
        <p><strong>Ni Kadek Imayani</strong></p>
    </div>

</body>
</html>
