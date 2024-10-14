@extends('layouts.master')
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
        <h3>DATA USER</h3>
        </div>
    </div>

        <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data User</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <a href="createdatauser" class="btn btn-success btn-sm"><i class="fa fa-plus-square">  Tambah Data</i></a>
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Nama User</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Status</th>
                          <th style="width: 20%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $no = 1; @endphp
                        @foreach($datauser as $datausers)
                        <tr>
                          <td>{{$no++}}</td>
                          <td>
                            <a>{{$datausers->name}}</a>
                            <br>
                            <small>Created {{$datausers->created_at}}</small>
                          </td>
                          <td>{{$datausers->email}}</td>
                          <td>{{$datausers->password}}</td>
                          <td>{{$datausers->status}}</td>
                          <td>
                            <a href="/editdatauser/{{$datausers->id}}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                            <a href="#" class="btn btn-danger btn-sm delete" data-name="{{$datausers->name}}" data-id="{{$datausers->id}}"><i class="fa fa-trash-o"></i> Delete </a>
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

        <script src="{{URL::asset('/Asset/vendors/jquery/dist/jquery.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('.delete').click(function(){
    var username = $(this).attr('data-name');
    var userid= $(this).attr('data-id');

    Swal.fire({
        title: 'Seken Hapus?',
        text: "Ane mehapus datane "+username+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/destroydatauser/"+userid+" "
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
  })
</script>
@endsection