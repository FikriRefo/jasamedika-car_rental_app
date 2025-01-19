@extends('layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- Flash Message -->
        @if (session('success'))
            <div class="alert alert-success flash-message" style="display: none;">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Pengembalian Mobil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Daftar Pengembalian Mobil</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Trigger Modal Button -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#returnModal">
                            Kembalikan Mobil
                        </button>
                        <br><br>
                        <!-- Tabel Pengembalian Mobil -->
                        <table id="returnTable" class="table table-bordered table-striped mt-4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mobil</th>
                                    <th>Nomor Plat</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Durasi Penyewaan</th>
                                    <th>Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($returns as $return)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $return->rental->car->brand }} {{ $return->rental->car->model }}</td>
                                        <td>{{ $return->rental->car->license_plate }}</td>
                                        <td>{{ $return->returned_at }}</td>
                                        <td>{{ $return->days_used }} hari</td>
                                        <td>Rp {{ number_format($return->total_cost, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">Pengembalian Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('returns.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="plate_number">Nomor Plat Mobil</label>
                        <input type="text" name="plate_number" id="plate_number" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kembalikan Mobil</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('footer')
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#returnTable').DataTable({
            "responsive": true,
            "searching": true,
            "lengthChange": true
        });

        // Flash message dengan efek fade and slide
        if ($('.flash-message').length) {
            $('.flash-message').slideDown(400).delay(3000).slideUp(400);
        }
    });
</script>
@endsection
