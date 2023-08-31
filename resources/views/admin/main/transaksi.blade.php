@extends('admin.header.header')

@section('main')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="d-flex align-items-center justify-content-between card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Transaksi Pending</h6>



        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Total</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Bukti TF</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Total</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Bukti TF</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- @ digunakan untuk pembukaan fungsi php --}}
                        @foreach ($listTransaksiPending as $transaksi)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $transaksi->id }}</td>
                                <td>Rp. {{ number_format($transaksi->total_transfer) }}</td>
                                <td>{{ $transaksi->bank }}</td>
                                <td>{{ $transaksi->status }}</td>
                                <td><a href="{{ asset('storage/transfer/' . $transaksi->bukti_transfer) }}"
                                        target="blank">{{ $transaksi->bukti_transfer }}</a> </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('transaksiConfirm', $transaksi->id) }}"><button
                                                class="btn btn-sm btn-success">Proses</button></a>
                                        <a href="{{ route('transaksiBatal', $transaksi->id) }}"><button
                                                class="btn btn-sm btn-danger">Batal</button></a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="d-flex align-items-center justify-content-between card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Transaksi Selesai</h6>



        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Total</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Bukti TF</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Total</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Bukti TF</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- @ digunakan untuk pembukaan fungsi php --}}
                        @foreach ($listTransaksiSelesai as $transaksi)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $transaksi->id }}</td>
                                <td>Rp. {{ number_format($transaksi->total_transfer) }}</td>
                                <td>{{ $transaksi->bank }}</td>
                                <td>{{ $transaksi->status }}</td>

                                <td><a href="{{ asset('storage/transfer/' . $transaksi->bukti_transfer) }}"
                                        target="blank">{{ $transaksi->bukti_transfer }}</a> </td>
                                <td>
                                    <div class="d-flex justify-content-center">

                                        @if ($transaksi->status == 'DIKIRIM')
                                            <a class="d-block"
                                                href="{{ route('transaksiSelesai', $transaksi->id) }}"><button
                                                    class="btn btn-sm btn-primary">Selesai</button></a>
                                        @elseif($transaksi->status == 'PROSES')
                                            <a class="d-block" href="{{ route('transaksiKirim', $transaksi->id) }}"><button
                                                    class="btn btn-sm btn-success">Kirim</button></a>
                                        @elseif($transaksi->status == 'SELESAI' || $transaksi->status == 'BATAL')
                                            <a class="d-block" href="{{ route('transaksiKirim', $transaksi->id) }}"><button
                                                    class="btn btn-sm btn-warning">Detail</button></a>
                                        @elseif($transaksi->status == 'DIBAYAR')
                                            <a class="d-block"
                                                href="{{ route('transaksiConfirm', $transaksi->id) }}"><button
                                                    class="btn btn-sm btn-warning">Proses</button></a>
                                        @endif

                                        {{-- <a href="{{ route('transaksiBatal', $transaksi->id) }}"><button
                                            class="btn btn-sm btn-danger" hidden>Batal</button></a> --}}
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
