<div>
    <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/">Dashboard</a></li>
                      <li><a href="#">Profil</a></li>
                    </ul>
                  </li>
                  
                  <br>
                  <h3>Data Administrator</h3>
                  @if (Auth::user()->status == "Pengurus" || Auth::user()->status == "Ketua")
                  <li><a><i class="fa fa-users"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="/datauser"> Data Users</a></li>
                        <li><a href="/dataanggota"> Angota STT</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-book"></i> Absensi <span class="fa fa-chevron-down"></a>
                    <ul class="nav child_menu">
                          <li><a href="/absensi"> Buat Absensi</a></li>
                          <li><a href="/laporan-absensi"> Laporan Absensi</a></li>
                      </ul>
                  </li>
                  <li><a><i class="fa fa-money"></i> Data KAS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/datakasmasuk">KAS Masuk</a></li>
                      <li><a href="/datakaskeluar">KAS Keluar</a></li>
                      <li><a href="/laporankas">Laporan KAS</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-tags"></i> Kewajiban <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Iuran Bulanan</a></li>
                      <li><a href="/form-denda">Denda</a></li>
                      <li><a href="#">Penekelan</a></li>
                    </ul>
                  </li>
                  @endif
                  <br>
                  <h3>Data Kegiatan STT</h3>
                  <li><a><i class="fa fa-asterisk"></i> Kegiatan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @if (Auth::user()->status == "Pengurus" || Auth::user()->status == "Ketua")
                      <li><a href="/kegiatan">Kegiatan Baru</a></li>
                      @endif
                      <li><a href="/pilihevent">Form Kegiatan</a></li>
                      <li><a href="/pilihlaporan">Laporan Kegiatan</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
          </div>
</div>
