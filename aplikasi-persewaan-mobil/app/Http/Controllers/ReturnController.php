<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\ReturnCar as ReturnModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    public function create()
    {
        return view('returns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|exists:cars,plate_number',
        ]);

        // Cari mobil berdasarkan nomor plat
        $car = Car::where('plate_number', $request->plate_number)->first();

        // Cari data rental mobil yang masih aktif
        $rental = Rental::where('car_id', $car->id)
            ->where('user_id', Auth::id())
            ->whereNotIn('id', ReturnModel::pluck('rental_id'))
            ->first();

        if (!$rental) {
            return back()->withErrors('Mobil tidak ditemukan dalam daftar penyewaan aktif Anda.');
        }

        // Hitung jumlah hari penyewaan
        $startDate = strtotime($rental->start_date);
        $endDate = strtotime($rental->end_date);
        $returnedAt = now();
        $daysUsed = ceil((strtotime($returnedAt) - $startDate) / 86400);;

        // Hitung biaya total berdasarkan tarif harian
        $totalCost = $daysUsed * $rental->car->rental_rate_per_day;

        // Simpan data pengembalian
        ReturnModel::create([
            'rental_id' => $rental->id,
            'returned_at' => $returnedAt,
            'days_used' => $daysUsed,
            'total_cost' => $totalCost,
        ]);

        // Perbarui status mobil menjadi tersedia
        $car->update(['is_available' => true]);

        return redirect()->route('returns.index')->with('success', 'Mobil berhasil dikembalikan.');
    }

    public function index()
    {
        $returns = ReturnModel::whereHas('rental', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('rental.car')->get();

        return view('returns.index', compact('returns'));
    }
}
