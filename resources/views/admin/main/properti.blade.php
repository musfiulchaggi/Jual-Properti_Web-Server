@extends('admin.header.header')

@section('main')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Properti</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="d-flex align-items-center justify-content-between card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Properti</h6>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-fw fa-plus"></i>
                Tambah Properti
            </button>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Poperti</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @auth
                            <form action="{{ route('properti.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">

                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" id="user_id" name="user_id"
                                                value="{{ auth()->user()->id }}" hidden>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="harga" class="col-12 col-form-label">Harga</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="harga" name="harga">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" type="text" name="deskripsi" id="deskripsi" rows="3"></textarea>
                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="lattitude" class="col-12 col-form-label">Lattitude</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="lattitude" name="lattitude">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="longitude" class="col-12 col-form-label">Longitude</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="longitude" name="longitude">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="phone" class="col-12 col-form-label">Phone</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="phone" name="phone">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="email" class="col-12 col-form-label">Email</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="provinsi" class="col-12 col-form-label">Provinsi</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="provinsi" name="provinsi">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="kabupaten" class="col-12 col-form-label">Kabupaten</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="kabupaten" name="kabupaten">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="kecamatan" class="col-12 col-form-label">Kecamatan</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <label for="gambar" class="col-12 col-form-label">File Gambar</label>
                                        <div class="col">

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gambar"
                                                    name="gambar" aria-describedby="inputGroupFileAddon03">
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
                    @endauth

                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Harga</th>
                            <th>Lattitude</th>
                            <th>Longitude</th>
                            <th>Deskripsi</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Gambar</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- @ digunakan untuk pembukaan fungsi php --}}
                        @foreach ($listProperti as $ppt)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $ppt->user_id }}</td>
                                <td>Rp. {{ number_format($ppt->harga) }}</td>
                                <td>{{ $ppt->lattitude }}</td>
                                <td>{{ $ppt->longitude }}</td>
                                <td>{{ $ppt->deskripsi }}</td>
                                <td>{{ $ppt->phone }}</td>
                                <td>{{ $ppt->email }}</td>
                                <td>{{ $ppt->provinsi }}</td>
                                <td>{{ $ppt->kabupaten }}</td>
                                <td>{{ $ppt->kecamatan }}</td>
                                <td>

                                    @foreach ($listGambar as $gb)
                                        @if ($gb->properti_id == $ppt->id)
                                            <a class="d-block"
                                                href="{{ asset('storage/gambar_properti/' . $gb->gambar) }}"
                                                target="blank">{{ $gb->gambar }}</a>
                                        @endif
                                    @endforeach

                                </td>
                                <td>{{ $ppt->updated_at }}</td>
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
