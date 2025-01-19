<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::where('user_id', Auth::id())->with('car')->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $cars = Car::where('is_available', true)->get();
        return view('rentals.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $conflict = Rental::where('car_id', $request->car_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors('Mobil tidak tersedia pada tanggal yang diminta.');
        }

        $car = Car::findOrFail($request->car_id);
        $days = (strtotime($request->end_date) - strtotime($request->start_date)) / 86400 + 1;
        $total_price = $days * $car->rental_rate_per_day;

        Rental::create([
            'car_id' => $request->car_id,
            'user_id' => Auth::id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $total_price,
        ]);

        $car->update(['is_available' => false]);

        return redirect()->route('peminjaman.index')->with('success', 'Mobil berhasil dipesan.');
    }
}
