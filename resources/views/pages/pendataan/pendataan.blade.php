<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Anggota STT Sila Dharma Cempaga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 30px;
        }
        .btn-primary {
            border-radius: 30px;
            padding: 12px 30px;
        }
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Form Pendataan Anggota STT</h3>
                        <form action="{{ route('pendataan.store') }}" method="POST">
                            @csrf
                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tglLahir" name="tglLahir" required>
                            </div>
                            <!-- Umur -->
                            <div class="mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="number" class="form-control" id="umur" name="umur" placeholder="Diisi Otomasi" required readonly disabled>
                            </div>
                            <!-- Kegiatan -->
                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label">Kegiatan</label>
                                <select class="form-select" id="pekerjaan" name="pekerjaan" required>
                                    <option value="" disabled selected>Pilih Kegiatan</option>
                                    <option value="Siswa">Siswa</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Bekerja">Bekerja</option>
                                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                                </select>
                            </div>
                            <!-- Tempat -->
                            <div class="mb-3">
                                <label class="form-label">Tempek</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tempek" id="aktif" value="kangin" checked>
                                    <label class="form-check-label" for="aktif">Kangin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tempek" id="nekel" value="kauh">
                                    <label class="form-check-label" for="nekel">Kauh</label>
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">Status</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusAktif" value="aktif" checked>
                                    <label class="form-check-label" for="statusAktif">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusNekel" value="nekel">
                                    <label class="form-check-label" for="statusNekel">Nekel</label>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Script untuk menghitung umur otomatis berdasarkan tanggal lahir
        document.getElementById('tglLahir').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const currentDate = new Date();
            let age = currentDate.getFullYear() - birthDate.getFullYear();
            const month = currentDate.getMonth() - birthDate.getMonth();
            if (month < 0 || (month === 0 && currentDate.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('umur').value = age;
        });
    </script>
</body>
</html>
