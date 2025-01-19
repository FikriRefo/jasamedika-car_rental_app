@extends('layouts.auth')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    
    <div class="row justify-content-center w-100">
        @if (session('success'))
            <div class="alert alert-success flash-message" style="display: none;">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-8">
            <h2 class="text-center"><b>Rental App</b></h2><br>
            <div class="card login-card" style="background-color:#6e5101; box-shadow: 0 0 8px #6e5101">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <label class="text-white" for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                        <label class="text-white" for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                        <br><button type="submit" class="btn" style="color: #FFFFFF; background-color: #000000">Login</button>
                    </form>
                </div>
            </div>        
            <p class="mb-0" style="display: inline;">Belum Punya Akun? </p>
            <a href="{{ route('register.index') }}" class="btn btn-sm btn-link" style="text-decoration: none; display: inline;">Sign Up</a>
        </div>
    </div>
</div>

@endsection
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tampilkan flash message dengan efek fade and slide
        $('.flash-message').slideDown(400).delay(1000).slideUp(400);
    });
</script>
@endsection