@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Pengembalian Mobil</h2>
    <form action="{{ route('returns.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="license_plate">Nomor Plat Mobil</label>
            <input type="text" name="license_plate" id="license_plate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Kembalikan Mobil</button>
    </form>
</div>
@endsection
