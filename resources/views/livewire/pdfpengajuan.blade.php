<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keluar dan Rekomendasi Pengurus</title>
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

        .content p {
            text-align: justify;
        }

        .signature {
            display: block;
            margin-top: 40px;
            padding-top: 5px;
            text-decoration: underline;
        }

        .date {
            text-align: right;
            font-size: 12px;
            margin-top: 10px;
        }

        /* Pemisah Halaman */
        .page-break {
            page-break-before: always;
        }

        /* Tabel tanpa border */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 5px 20px;
            vertical-align: top;
        }

        /* Tabel Tanda Tangan */
        .signature-column {
            width: 33%;
            text-align: center;
            padding-top: 30px;
        }

        table td.signature {
            text-align: right;
            padding-top: 30px;
            border: none;
        }

        table td.date {
            text-align: right;
            padding-right: 10px;
            font-size: 12px;
        }

    </style>
</head>

<body>

    <!-- Surat Permohonan Keluar -->
    <div class="content">
    <p class="date">Bangli, {{ date('d F Y') }}</p>

<p>Kepada Yth,<br>
Pengurus STT Sila Dharma<br>
Di Tempat</p>

<p>Dengan hormat,</p>

<p>Yang bertanda tangan di bawah ini:</p>

<table>
    <tr>
        <td>Nama</td>
        <td>: {{ $anggota->nama }}</td>
    </tr>
    <tr>
        <td>Tempek</td>
        <td>: {{ $anggota->tempek }}</td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td>
        <td>: {{ $anggota->tgllahir }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>: {{ $anggota->status }}</td>
    </tr>
</table>

<p>Dengan ini, saya mengajukan permohonan untuk keluar sebagai anggota STT Sila Dharma, dengan alasan sebagai berikut:</p>

<p><strong>{{ $dataout->alasankeluar}}</strong></p>

<p>Saya juga ingin menyatakan bahwa saya telah menyelesaikan seluruh kewajiban administrasi yang terkait dengan keanggotaan saya selama ini.</p>

<p>Sehubungan dengan itu, saya memohon agar pengurus STT Sila Dharma dapat memberikan izin untuk keluar dari keanggotaan ini, dan saya berharap agar proses administrasi dapat diselesaikan dengan baik.</p>

<p>Demikian surat permohonan ini saya buat dengan sebenar-benarnya. Saya mengucapkan terima kasih atas perhatian dan kerjasamanya selama ini.</p>

        <!-- Tanda Tangan Anggota -->
        <table style="width: 100%; margin-top: 50px; text-align: center; border-collapse: collapse;">
            <tr>
                <!-- Kolom Bendahara -->
                <td style="width: 33%;"></td>

                <!-- Kolom kosong untuk memisahkan -->
                <td style="width: 33%;"></td>

                <!-- Kolom Sekretaris -->
                <td colspan="3" style="padding-top: 50px; text-align: center;">
                    <p style="text-align: center;">Pemohon</p>
                    <span class="signature" style="text-align: center;">{{ $anggota->nama ?? '' }}</span><br>
                </td>
            </tr>
        </table>

    </div>

    <!-- Pemisah Halaman -->
    <div class="page-break"></div>

    <!-- Surat Rekomendasi Pengurus -->
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $data->logo))) }}" alt="Logo">
        <h1>STT SILA DHARMA</h1>
        <h2>Lingk./Br. Cempaga, Kelurahan Cempaga, Kecamatan Bangli Bali</h2>
        <h2>No. Tlp. 089603158518</h2>
    </div>

    <div class="content">
        <p class="date">Bangli, {{ date('d F Y') }}</p>

        <p>Kepada Yth,<br>
        Kelian Adat Br. Cempaga<br>
        Di Tempat</p>

        <p>Dengan hormat,</p>

        <p>Sehubungan dengan permohonan pengunduran diri anggota atas nama:</p>

        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $anggota->nama }}</td>
            </tr>
            <tr>
                <td>Tempek</td>
                <td>: {{ $anggota->tempek }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{ $anggota->tgllahir }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: {{ $anggota->status }}</td>
            </tr>
            <tr>
                <td>Alasan Keluar</td>
                <td>: {{ $dataout->alasankeluar }}</td>
            </tr>
        </table>

        <p>Setelah kami cek, yang bersangkutan telah memenuhi kewajiban administrasi dan tidak memiliki tunggakan. Oleh karena itu, kami memberikan rekomendasi agar permohonan keluar dapat diterima dan diproses sesuai ketentuan.</p>

        <p>Demikian surat rekomendasi ini kami buat untuk dapat diproses lebih lanjut.</p>

        <!-- Tanda Tangan Pengurus -->
        <table style="width: 100%; margin-top: 50px; text-align: center; border-collapse: collapse;">
            <tr>
                <!-- Kolom Bendahara -->
                <td style="width: 33%;"></td>

                <!-- Kolom kosong untuk memisahkan -->
                <td style="width: 33%;"></td>

                <!-- Kolom Sekretaris -->
                <td colspan="3" style="padding-top: 50px; text-align: center;">
                    <p style="text-align: center;">Mengetahui</p>
                    <p style="text-align: center;">Ketua STT</p>
                    <span class="signature" style="text-align: center;">{{ $pengurus->ketua ?? '' }}</span><br>
                </td>
            </tr>
        </table>

    </div>

      <!-- Pemisah Halaman -->
      <div class="page-break"></div>

    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $data->logo))) }}" alt="Logo">
        <h1>STT SILA DHARMA</h1>
        <h2>Lingk./Br. Cempaga, Kelurahan Cempaga, Kecamatan Bangli Bali</h2>
        <h3>No. Tlp. 089603158518</h3>
    </div>

    <div class="content">
        <h4 class="text-center">Surat Tunggakan</h4>

        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $anggota->nama }}</td>
            </tr>
            <tr>
                <td>Tempek</td>
                <td>: {{ $anggota->tempek }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{ $anggota->tgllahir }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: {{ $anggota->status }}</td>
            </tr>
        </table>

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
                <td style="width: 33%; text-align: center;">
                    <p style="text-align: center;">Bendahara</p>
                    <span class="signature" style="text-align: center;">{{ $pengurus->bendahara ?? '' }}</span><br>
                </td>

                <!-- Kolom kosong untuk memisahkan -->
                <td style="width: 33%;"></td>

                <td style="width: 33%; text-align: center;">
                    <p style="text-align: center;">Sekretaris</p>
                    <span class="signature" style="text-align: center;">{{ $pengurus->sekretaris ?? '' }}</span><br>
                </td>
            </tr>
            <tr>
                <!-- Kolom Sekretaris -->
                <td colspan="3" style="padding-top: 50px; text-align: center;">
                    <p style="text-align: center;">Mengetahui</p>
                    <p style="text-align: center;">Ketua STT</p>
                    <span class="signature" style="text-align: center;">{{ $pengurus->ketua ?? '' }}</span><br>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
