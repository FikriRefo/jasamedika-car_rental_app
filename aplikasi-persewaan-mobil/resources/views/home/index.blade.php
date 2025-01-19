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
                    <h1 class="m-0 text-dark">Welcome 2025</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Welcome 2025</li>
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
                            @if (session('user'))
                                <div class="alert bg-dark text-white">
                                    <h4>Profile Information</h4>
                                    <ul>
                                        <li><strong>Name:</strong> {{ session('user')->name }}</li>
                                        <li><strong>Email:</strong> {{ session('user')->email }}</li>
                                        <li><strong>Address:</strong> {{ session('user')->address }}</li>
                                        <li><strong>Phone Number:</strong> {{ session('user')->phone_number }}</li>
                                        <li><strong>SIM Number:</strong> {{ session('user')->sim_number }}</li>
                                    </ul>
                                </div>
                            @else
                                <div class="d-flex justify-content-between mb-2 pb-2">
                                    <h3 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Welcome 2025</h3>
                                </div>
                                <a class="btn btn-primary" href="{{ route('login.index') }}">Sign In</a>
                            @endif
                            
                            {{-- Tampilkan error validasi jika ada --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tampilkan flash message dengan efek fade and slide
            $('.flash-message').slideDown(400).delay(1000).slideUp(400);
        });
    </script>
           

@endsection
