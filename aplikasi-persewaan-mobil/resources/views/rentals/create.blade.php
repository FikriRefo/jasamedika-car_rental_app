@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Pesan Mobil</h2>
    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="car_id">Pilih Mobil</label>
            <select name="car_id" id="car_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }} (Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}/hari)</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">Tanggal Selesai</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Pesan</button>
    </form>
</div>
@endsection
