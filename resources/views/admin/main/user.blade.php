@extends('admin.header.header')

@section('main')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
  
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telp</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no=1; ?>
                        {{-- @ digunakan untuk pembukaan fungsi php --}}
                        @foreach ($listUser as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{  $user->email }}</td>
                                <td>{{ $user->phone  }}</td>
                                <td >
                                    <div class="d-flex justify-content-around">
                                        <a href=""><span class="badge badge-pill badge-primary"><i class="far fa-edit"></i></span></a>
                                        <a href=""><span class="badge badge-pill badge-warning"><i class="fas fa-trash-alt"></i></span></a>                                        
                                    </div>
                                </td>
                               
                            </tr>
                        @endforeach
                

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection