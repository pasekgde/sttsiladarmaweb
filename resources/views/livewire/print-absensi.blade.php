<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>STT Sila Darma Cempaga</h2>
        <p>Lingk./Br. Cempaga, Kelurahan Cempaga, Kecamatan Bangli, Bali</p>
        <p>Telp: 089765432123 | Kode Post: 80612</p>
        <hr>
    </div>

    <h3>Detail Kegiatan</h3>
    <p><strong>Tanggal Kegiatan:</strong> {{ $tanggal_kegiatan }}</p>
    <p><strong>Nama Kegiatan:</strong> {{ $nama_kegiatan }}</p>
    <p><strong>Jenis Kegiatan:</strong> {{ $jenis_kegiatan }}</p>
    <p><strong>Denda:</strong> {{ $denda }}</p>
    <p><strong>Keterangan:</strong> {{ $keterangan }}</p>

    <h3>Detail Anggota</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Anggota</th>
                <th>Tempat</th>
                <th>Status</th>
                <th>Presensi</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataanggota as $anggota)
                <tr>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->tempek }}</td>
                    <td>{{ $anggota->status }}</td>
                    <td>{{ $anggota->presensi }}</td>
                    <td>{{ $anggota->denda }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <button onclick="window.print()">Print</button>
    </div>
</body>
</html>
