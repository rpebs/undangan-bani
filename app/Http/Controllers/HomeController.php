<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function input(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keturunan_ke' => 'required|string|max:255',
            'bani' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'hp' => 'required|string',
            'pekerjaan' => 'required|string|max:255',
        ]);

        // Simpan ke database
        Person::create($validated);

        // Balikin respons JSON biar Swal bisa nampilin
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function tampilkanKeluarga()
    {
        $data = Person::all()->groupBy('bani');
        return view('keluarga', ['kelompokBani' => $data]);
    }

    public function indexForDelete()
    {
        $dataKeluarga = Person::all(); // Ambil semua data keluarga
        return view('list', compact('dataKeluarga'));
    }

    public function destroy($id)
    {
        $keluarga = Person::findOrFail($id);
        $keluarga->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
