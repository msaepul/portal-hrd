<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
class DepartemenController extends Controller
{
    public function showListDept()
    {
        $depts = Departemen::all();
        return view('masterdata.departemen',compact('depts'));
    }

    public function deptStore(Request $request)
    {
       // Validasi data yang dikirimkan oleh form
       $validatedData = $request->validate([
        'departemen' => 'required|string|max:255|unique:tb_dept,departemen',
        'catatan' => 'nullable|string',
    ], [
        'departemen.required' => 'Departemen harus diisi.',
        'departemen.string' => 'Departemen harus berupa teks.',
        'departemen.max' => 'Departemen tidak boleh lebih dari :max karakter.',
        'departemen.unique' => 'Departemen sudah ada dalam database.',
        'catatan.string' => 'Catatan harus berupa teks.',
    ]);

    // Buat instance dari model Departemen dengan data yang divalidasi
    $departemen = Departemen::create($validatedData);

    // Redirect ke halaman yang sesuai setelah menyimpan data
    return redirect()->route('masterdata.dept');
    }
}
