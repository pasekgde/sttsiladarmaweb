<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi</title>
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
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $data->logo))) }}" alt="Logo">
        <h1>STT SILA DHARMA</h1>
        <h2>Lingk./Br. Cempaga, Kelurahan Cempaga, Kecamatan Bangli Bali</h2>
        <h3>No. Tlp. 089603158518</h3>
    </div>

    <div class="content">
        <h3 class="text-center">Data Laporan Absensi STT</h3>

        <div class="summary">
            <table class="table table-bordered">
                <tr>
                    <th class="table-primary">Tanggal Kegiatan</th>
                    <td>{{$kegiatan->tanggal_kegiatan}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Nama Kegiatan</th>
                    <td>{{$kegiatan->nama_kegiatan}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Denda</th>
                    <td>Rp {{ number_format($kegiatan->denda, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Denda</th>
                    <td>Rp {{ number_format($kegiatan->total_denda, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Anggota</th>
                    <td>{{$kegiatan->total_anggota}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Hadir</th>
                    <td>{{$kegiatan->total_hadir}}</td>
                </tr>
                <tr>
                    <th class="table-primary">Total Tidak Hadir</th>
                    <td>{{$kegiatan->total_tidak_hadir}}</td>
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
            <th class="table-primary">Presensi</th>
            <th class="table-primary">Denda</th>
            <th class="table-primary">Status</th>
            <th class="table-primary">Tanggal Bayar</th>
        </tr>
    </thead>
        <tbody>
            @foreach ($absensiData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ ucwords(strtolower($data['nama_anggota'])) }}</td>
                    <td>{{ $data['presensi'] }}</td>
                    <td>Rp {{ number_format($data['denda'], 0, ',', '.') }}</td>
                    <td>{{ $data['statusaksi'] }}</td>
                    <td>
                        {{ $data['tanggal_bayar'] ? \Carbon\Carbon::parse($data['tanggal_bayar'])->format('d-m-Y') : 'Data tidak ditemukan' }}
                    </td>

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
    </div>
</body>

</html>
