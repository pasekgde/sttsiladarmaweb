@extends('layouts.master')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
        <h3>DATA ANGGOTA</h3>
        </div>
    </div>

        <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>DATA ANGGOTA</h2>
                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                        <a href="createanggota" class="btn btn-success"><i class="fa fa-plus-square">  Tambah Data</i></a>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th style="width: 300px;">Nama</th>
                                        <th style="width: 100px;">Tanggal Lahir</th>
                                        <th style="width: 10px;">Umur</th>
                                        <th style="width: 150px;">Pekerjaan</th>
                                        <th style="width: 100px;">Tempek</th>
                                        <th style="width: 10px;">Status</th>
                                        <th style="width: 70px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($dataanggota as $dataanggotas)
                                    <tr>
                                        <td style="width:2%">{{$no++}}</td>
                                        <td>{{$dataanggotas->nama}}</td>
                                        <td>{{$dataanggotas->tgllahir}}</td>
                                        <td>{{$dataanggotas->umur_sekarang}}</td>
                                        <td>{{$dataanggotas->pekerjaan}}</td>
                                        <td>{{$dataanggotas->tempek}}</td>
                                        <td>{{$dataanggotas->status}}</td>
                                        <td>
                                            <a href="/editanggota/{{$dataanggotas->idanggota}}"><i class="fa fa-pencil"></i> Edit </a>&nbsp&nbsp&nbsp
                                            <a href="#" class="delete" data-name="{{$dataanggotas->nama}}" data-id="{{$dataanggotas->idanggota}}"><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Datatables -->
<script src="{{URL::asset('/Asset/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        $('#datatable').dataTable( {
            "lengthMenu": [ [50, 100, -1],[50, 100, "All"] ]
            } );
    

    $('.delete').click(function(){
    var nama = $(this).attr('data-name');
    var id= $(this).attr('data-id');

    Swal.fire({
        title: 'Seken Hapus?',
        text: "Ane mehapus datane "+nama+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/destraoyatanggota/"+id+" "
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
                )
            }
          })
    })

})
</script>
@endsection