@extends('admin.header.header')

@section('main')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Produk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="d-flex align-items-center justify-content-between card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Produk</h6>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-fw fa-plus"></i>
                Tambah Produk
            </button>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">

                                <div class="row">
                                    <label for="nama" class="col-12 col-form-label">Nama</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="harga" class="col-md-6 col-form-label">Harga</label>
                                    <label for="kategori" class="col-md-6 col-form-label">Pilih Category</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" name="harga" class="form-control" id="harga">
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="kategori" name="kategori_id">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" type="text" name="deskripsi" id="deskripsi" rows="3"></textarea>
                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <label for="gambar" class="col-12 col-form-label">File Gambar</label>
                                    <div class="col">

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gambar" name="gambar"
                                                aria-describedby="inputGroupFileAddon03">
                                            <label class="custom-file-label" for="gambar">Choose file</label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- @ digunakan untuk pembukaan fungsi php --}}
                        @foreach ($listProduk as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>Rp. {{ number_format($user->harga) }}</td>
                                <td>{{ $user->deskripsi }}</td>
                                <td>{{ $user->gambar }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href=""><span class="badge badge-pill badge-primary"><i
                                                    class="far fa-edit"></i></span></a>
                                        <a href=""><span class="badge badge-pill badge-warning"><i
                                                    class="fas fa-trash-alt"></i></span></a>
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
