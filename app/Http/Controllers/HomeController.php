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
            'nama_orang_tua' => 'nullable|string|max:255',
            'bani' => 'required|string|max:255',
            'bani_lainnya' => 'nullable|string|max:255', // Optional, tapi dibaca saat 'Lainnya'
            'alamat' => 'required|string|max:255',
            'hp' => 'required|string',
            'pekerjaan' => 'required|string|max:255',
            'is_menantu' => 'required', // Tambahkan validasi untuk is_menantu
        ]);

        // Ganti nilai 'bani' kalau user pilih "Lainnya"
        $validated['bani'] = $validated['bani'] === 'Lainnya'
            ? $validated['bani_lainnya']
            : $validated['bani'];

        // Hapus input bantuannya biar gak kesimpen ke kolom yang nggak ada
        unset($validated['bani_lainnya']);

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

    public function undian()
    {
        return view('undian');
    }

    public function getNama()
    {

        $data = Person::select('nama', 'nama_orang_tua', 'is_menantu')->get();
        return response()->json($data);
    }
}
