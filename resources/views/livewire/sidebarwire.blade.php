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
                  @if (Auth::user()->status == "Superadmin" || Auth::user()->status == "Ketua" || Auth::user()->status == "Pengurus")
                  <h3>Data Administrator</h3>
                      <li><a><i class="fa fa-users"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                          @if (Auth::user()->status == "Superadmin" || Auth::user()->status == "Ketua")
                              <li><a href="/datauser"> Data Users</a></li>
                          @endif
                              <li><a href="/dataanggota"> Anggota STT</a></li>
                              
                          </ul>
                      </li>
                  @endif

                  @if (Auth::user()->status == "Superadmin" || Auth::user()->status == "Ketua" || Auth::user()->status == "Pengurus")
                      <li><a><i class="fa fa-book"></i> Absensi <span class="fa fa-chevron-down"></span></a>
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
                              <li><a href="/iuran-wajib">Iuran Bulanan</a></li>
                              <li><a href="/form-denda">Denda</a></li>
                              <li><a href="/penekelan">Penekelan</a></li>
                          </ul>
                      </li>
                  @endif

                  <br>
                  <h3>Data Kegiatan STT</h3>
                  <li><a><i class="fa fa-asterisk"></i> Kegiatan <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                          @if (Auth::user()->status == "Superadmin" || Auth::user()->status == "Ketua")
                              <li><a href="/kegiatan">Kegiatan Baru</a></li>
                          @endif
                          <li><a href="/pilihevent">Form Kegiatan</a></li>
                          <li><a href="/pilihlaporan">Laporan Kegiatan</a></li>
                      </ul>
                  </li>
                </ul>

                @if (Auth::user()->status == "Superadmin")
                <ul class="nav side-menu">
                    <h3>PENGOLAHAN SUPERADMIN</h3>
                    <li><a><i class="fa fa-book"></i> Setting <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                              <li><a href="/superadmin-sisteminfo"> Informasi dan Gambar</a></li>
                              <li><a href="/superadmin-pengurusinfo"> Pengurus Inti</a></li>
                              <li><a href="/superadmin-truncatedata"> Truncate Data !</a></li>
                          </ul>
                      </li>
                </ul>
                @endif
              </div>

            </div>
          </div>
</div>
