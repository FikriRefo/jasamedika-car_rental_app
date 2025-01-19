@extends('layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Update Mobil</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('mobil.update', $car->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $car->id }}">
                            <input type="hidden" name="user_id" value="{{ $car->user_id }}">
                            <input type="hidden" name="is_active" value="{{ $car->is_available }}">
                            <div class="form-group">
                                <label for="brand">Merek Mobil:</label>
                                <input type="text" name="brand" value="{{ $car->brand }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="model">Model Mobil:</label>
                                <input type="text" name="model" value="{{ $car->model }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="plate_number">Nomor Plat:</label>
                                <input type="text" name="plate_number" value="{{ $car->plate_number }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="rental_rate_per_day">Tarif Sewa per Hari:</label>
                                <input type="number" name="rental_rate_per_day"  value="{{ $car->rental_rate_per_day }}" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Mobil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
