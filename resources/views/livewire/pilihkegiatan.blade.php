<div>
    <div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Pilih Kegiatan  <small>Pilih kegiatan yang akan diinput</small></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pilih Kegiatan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<table class="table table-striped table-bordered table-hover">
													<thead class="table-dark" style="text-align:center">
														<tr>
														<th scope="col">#</th>
														<th scope="col">Nama Kegiatan</th>
														<th scope="col">Aksi</th>
														</tr>
													</thead>
													<tbody>
														@php $no = 1; @endphp
														@foreach ($data as $keg)
														<tr>
															<th scope="row" style="text-align:center">{{$no++}}</th>
															<td>{{$keg->namakegiatan}}</td>
															<td style="text-align:center">
																<a href="{{ url('/pilihevent/'.$keg->id) }}" class="btn btn-success">Pilih</a>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
												<div class="float-right">
													{{ $data->links() }}
												</div>
											</div>
										</div>

										<div class="ln_solid"></div>
									</form>
								</div>
							</div>
						</div>
					</div>
</div>
