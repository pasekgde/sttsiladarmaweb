<div>
     <!-- Jika ada data baru di Pendataan, tampilkan notifikasi -->
    <!-- @if($newPendataanNotification)
        <div class="alert alert-success">
            <strong>Notifikasi!</strong> Ada data baru yang ditambahkan pada Pendataan.
        </div>
    @endif -->
@if (Auth::user()->status == "Superadmin" || Auth::user()->status == "Ketua" || Auth::user()->status == "Pengurus")
            <div class="x_panel">
                  <div class="x_title">
                    <h2>DATA UMUM</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-primary-custom">
                            <div class="card-body">
                                <h5 class="card-title">Kas Masuk</h5>
                                <p class="card-text">Rp. {{ number_format($kasmasuk, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kotak 2: Jumlah Posts -->
                    <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-primary-custom">
                            <div class="card-body">
                                <h5 class="card-title">Kas Keluar</h5>
                                <p class="card-text">Rp. {{ number_format($kaskeluar, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kotak 3: Jumlah Comments -->
                    <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-primary-custom">
                            <div class="card-body">
                                <h5 class="card-title">Saldo Kas</h5>
                                <p class="card-text">Rp. {{ number_format($saldokas, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-success-custom">
                            <div class="card-body">
                                <h5 class="card-title">Anggota</h5>
                                <p class="card-text">{{$anggota}} Orang</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-success-custom">
                            <div class="card-body">
                                <h5 class="card-title">Calon Anggota</h5>
                                <p class="card-text">{{$pendataan}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-warning-custom">
                            <div class="card-body">
                                <h5 class="card-title">Denda</h5>
                                <p class="card-text">Rp. {{ number_format($tabelkegiatan, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-warning-custom">
                            <div class="card-body">
                                <h5 class="card-title">Iuran</h5>
                                <p class="card-text">Rp. {{ number_format($iuran, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-danger-custom">
                            <div class="card-body">
                                <h5 class="card-title">Nikel Denda</h5>
                                <p class="cardss-text">{{$penikelan}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="card text-white h-100 card-custom bg-danger-custom">
                            <div class="card-body">
                                <h5 class="card-title">Pengajuan Out</h5>
                                <p class="card-text">{{$outstt}}</p>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
@endif

                @foreach($datateskegiatan as $datas)
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DATA KEGIATAN BERJALAN : {{$datas->namakegiatan}}</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="col-md-2 mb-3">
                          <div class="card text-white h-100 card-custom bg-primary-custom">
                              <div class="card-body">
                                  <h5 class="card-title">Kas Masuk</h5>
                                  <p class="card-text">Rp. {{ number_format($datas->kasmasuk, 0, ',', '.') }}</p>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-2 mb-3">
                          <div class="card text-white h-100 card-custom bg-warning-custom">
                              <div class="card-body">
                                  <h5 class="card-title">Kas Keluar</h5>
                                  <p class="card-text">Rp. {{ number_format($datas->kaskeluar, 0, ',', '.') }}</p>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-2 mb-3">
                          <div class="card text-white h-100 card-custom bg-danger-custom">
                              <div class="card-body">
                                  <h5 class="card-title">Saldo</h5>
                                  <p class="card-text">Rp. {{ number_format($datas->saldo, 0, ',', '.') }}</p>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-4 mb-3">
                          <div class="card text-white h-100 card-custom bg-danger-custom">
                              <div class="card-body">
                                  <h5 class="card-title">Panitia : {{$datas->namakegiatan}}</h5>
                                  <p>Ketua : {{$datas->ketuapanitia}}</p>
                                  <p>Sekretaris : {{$datas->sekretarispanitia}}</p>
                                  <p>Bendahara : {{$datas->bendaharapanitia}}</p>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
                @endforeach
</div>
