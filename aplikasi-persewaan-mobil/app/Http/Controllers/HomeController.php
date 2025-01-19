<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = session('user'); 
        return view('home.index', compact('user'));
    }

    public function mobil()
    {
        $cars = Car::all();
        return view('home.mobil', compact('cars'));
    }

    public function create()
    {
        return view('home.create');
    }
    public function store(Request $request)
    {
        if (!session()->has('user')) {
            abort(403, 'Anda harus login terlebih dahulu.');
        }

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'plate_number' => 'required|string|max:50|unique:cars,plate_number,',
            'rental_rate_per_day' => 'required|numeric|min:0',
        ]);

        $car = Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'plate_number' => $request->plate_number,
            'rental_rate_per_day' => $request->rental_rate_per_day,
            'is_available' => 1,
            'user_id' => session('user')->id, 
        ]);

        // dd($car);
        return redirect('/mobil')->with('success', 'Mobil berhasil ditambahkan.');
    }


    public function search(Request $request)
    {
        $query = Car::query();

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }

        if ($request->filled('is_available')) {
            $query->where('is_available', $request->is_available);
        }

        $cars = $query->get();
        return view('home.mobil', compact('cars'));
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        // return response()->json($car);
        return view('home.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'plate_number' => 'required|string|max:50|unique:cars,plate_number,' . $id,
            'rental_rate_per_day' => 'required|numeric|min:0',
        ]);

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return redirect('/mobil')->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        // Check if the car is available (is_available == 0)
        if ($car->is_available == 0) {
            return response()->json(['error' => 'Mobil tidak dapat dihapus karena tidak tersedia.'], 400);
        }

        // Delete the car if it's available
        $car->delete();

        return response()->json(['success' => 'Mobil berhasil dihapus.']);
    }

}
