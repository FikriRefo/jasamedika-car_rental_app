@extends('layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success flash-message" style="display: none;">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Mobil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Daftar Mobil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('mobil.search') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="brand" placeholder="Merek Mobil"
                                               value="{{ request('brand') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="model" placeholder="Model Mobil"
                                               value="{{ request('model') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="is_available">
                                            <option value="">Ketersediaan</option>
                                            <option value="1" {{ request('is_available') == '1' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="0" {{ request('is_available') == '0' ? 'selected' : '' }}>Tidak Tersedia</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </form>
                            <br>

                            <div>
                                <a href="{{ route('mobil.create') }}" class="btn btn-success">Tambah Mobil Baru</a>
                            </div><br><br>
                            <table id="carTable" class="table table-bordered table-striped mt-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Merek</th>
                                        <th>Model</th>
                                        <th>Nomor Plat</th>
                                        <th>Tarif Sewa</th>
                                        <th>Ketersediaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $car)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $car->brand }}</td>
                                            <td>{{ $car->model }}</td>
                                            <td>{{ $car->plate_number }}</td>
                                            <td>Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}</td>
                                            <td>{{ $car->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                                            <td>
                                                @if (auth()->check() && auth()->id() === $car->user_id)
                                                    <a href="mobil/{{ $car->id }}/edit" class="btn btn-info btn-sm">Edit</a>
                                                    {{-- <button class="btn btn-warning btn-sm edit-button" data-id="{{ $car->id }}">Edit</button> --}}
                                                    <button class="btn btn-danger btn-sm delete-button" data-id="{{ $car->id }}">Hapus</button>    
                                                @else
                                                    <button class="btn btn-secondary btn-sm" disabled>Edit</button>
                                                    <button class="btn btn-secondary btn-sm" disabled>Hapus</button>
                                                @endif                                            
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
    </div>
    {{-- Modal Edit --}}
    <div class="modal fade" id="editCarModal" tabindex="-1" role="dialog" aria-labelledby="editCarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editCarForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCarModalLabel">Edit Mobil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_car_id" name="id">
                        <div class="form-group">
                            <label>Merek</label>
                            <input type="text" id="edit_brand" name="brand" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" id="edit_model" name="model" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor Plat</label>
                            <input type="text" id="edit_plate_number" name="plate_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tarif Sewa</label>
                            <input type="number" id="edit_rental_rate_per_day" name="rental_rate_per_day" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tampilkan flash message dengan efek fade and slide
            $('.flash-message').slideDown(400).delay(1000).slideUp(400);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#carTable').DataTable({
                "responsive": true,
                "searching": true,
                "lengthChange": true
            });
        });
        // $(document).on('click', '.edit-button', function () {
        //     const id = $(this).data('id');
        //     $.ajax({
        //         url: `/mobil/${id}/edit`,
        //         type: 'GET',
        //         success: function (data) {
        //             $('#edit_car_id').val(data.id);
        //             $('#edit_brand').val(data.brand);
        //             $('#edit_model').val(data.model);
        //             $('#edit_plate_number').val(data.plate_number);
        //             $('#edit_rental_rate_per_day').val(data.rental_rate_per_day);
        //             $('#editCarForm').attr('action', `/mobil/${data.id}`);
        //             $('#editCarModal').modal('show');
        //         },
        //         error: function () {
        //             Swal.fire('Error!', 'Gagal mengambil data mobil.', 'error');
        //         }
        //     });
        // });

        $(document).on('click', '.delete-button', function () {
            const id = $(this).data('id');
            const isAvailable = $(this).data('is_available');

            // Check if the car is available
            if (isAvailable == 0) {
                Swal.fire('Tidak Tersedia', 'Mobil tidak dapat dihapus karena tidak tersedia.', 'warning');
                return; // Exit the function if car is not available
            }

            // Proceed with deletion confirmation if car is available
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/mobil/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function () {
                            Swal.fire('Deleted!', 'Mobil berhasil dihapus.', 'success');
                            location.reload();
                        },
                        error: function () {
                            Swal.fire('Error!', 'Gagal menghapus mobil.', 'error');
                        }
                    });
                }
            });
        });



    </script>

@endsection
