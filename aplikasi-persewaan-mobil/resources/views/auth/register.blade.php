@extends('layouts.auth')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-8">
            <h2 class="text-center"><b>Rental App Registration</b></h2><br>            
            <div class="card login-card" style="background-color:#6e5101; box-shadow: 0 0 10px #6e5101">
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="text-white">Nama:</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="text-white">Alamat:</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="text-white">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number" class="text-white">Nomor Telepon:</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Nomor Telepon" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sim_number" class="text-white">Nomor SIM:</label>
                                    <input type="text" class="form-control" name="sim_number" id="sim_number" placeholder="Nomor SIM" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="text-white">Password:</label>
                                    <input type="password" class="form-control" name="password" id="password" minlength="8" required>
                                    <small class="text-white">Password must be at least 8 characters long</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="text-white">Konfirmasi Password:</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" minlength="8" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-block btn-dark">Register</button>
                    </form>             
                </div>
            </div>             
        </div>
    </div>
</div>
@endsection
