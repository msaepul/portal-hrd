<?php

namespace App\Http\Controllers;

use App\Models\cabang;
use App\Models\Departemen;
use App\Models\Loker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LokerController extends Controller
{
    public function index()
    {
        $cabang = cabang::all();
        $loker = Loker::where('status', '=', '1')->get();
        return view('landing', compact('cabang', 'loker'));
    }

    public function showListLoker()
    {
        $lokers=Loker::where('id_cabang','=',getUserIDCabang())->get();
        return view('loker.list',compact('lokers'));
    }
    public function lokerdetail()
    {
        $cabang = cabang::all();
        $loker = Loker::where('status', '=', '1')->get();
        return view('loker.lokerdetail', compact('cabang', 'loker'));
    }

    public function addLoker()
    {
        $depts = Departemen::all();
        $cabang = cabang::all();
        return view('loker.addloker', compact('depts','cabang'));
    }

    public function addLokerstore(Request $request)
    {
        $cabang = $request->input('id_cabang');
        $depts = $request->input('id_dept');
        $content1 = $request->input('quill_content1');
        $content2 = $request->input('quill_content2');
        $startdate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
        $enddate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
        // Mengambil nilai dari masing-masing checkbox
        $gender = $request->input('gender', 0); // Mengambil nilai dari input checkbox1 atau kembalikan 0 jika tidak ada
        $date_birth = $request->input('date_birth', 0); // Mengambil nilai dari input checkbox2 atau kembalikan 0 jika tidak ada
        $country = $request->input('country', 0); // Mengambil nilai dari input checkbox3 atau kembalikan 0 jika tidak ada
        $profile_image = $request->input('profile_image', 0); // Mengambil nilai dari input checkbox4 atau kembalikan 0 jika tidak ada
        $resume = $request->input('resume', 0); // Mengambil nilai dari input checkbox5 atau kembalikan 0 jika tidak ada
        $tac = $request->input('tac', 0); // Mengambil nilai dari input checkbox6 atau kembalikan 0 jika tidak ada
        $cv = $request->input('cv', 0); // Mengambil nilai dari input checkbox7 atau kembalikan 0 jika tidak ada
        $pf = $request->input('pf', 0); // Mengambil nilai dari input checkbox7 atau kembalikan 0 jika tidak ada
        $generate = Loker::generateNomor();

        // // Simpan data ke basis data
        Loker::create([
            'id_loker' => $generate,
            'id_cabang' =>$cabang,
            'id_dept' => $depts,
            'desc_job' => $content1,
            'require_job' => $content2,
            'start_date' => $startdate,
            'end_date' => $enddate,
            'resume' =>$resume,
            'gender'=>$gender,
            'date_birth'=>$date_birth,
            'country'=>$country,
            'profile_image'=>$profile_image,
            'cv'=>$cv,
            'tac'=>$tac,

            'status'=>1

        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');

    }

     public function updateStatus(Request $request, $id)
    {

         // Ambil data Loker dari database berdasarkan $id
    $loker = Loker::find($id);

    $loker->status = $loker->status == 1 ? 0 : 1;

    // Simpan perubahan ke database
    $loker->save();

        // Loker::create($request->all());
        // // Membuat data Loker baru berdasarkan data yang diambil dari request

        return redirect()->route('loker')->with('success', 'Data loker berhasil diupdate.');
        // Melakukan redirect dan menyertakan pesan sukses
    }

    public function showEditloker($id)
    {
        $depts = Departemen::all();
        $cabang = cabang::all();
        $loker = Loker::findOrFail($id);
        // Melakukan pengecekan apakah data dengan ID yang diberikan ditemukan atau tidak

        return view('loker.editloker', compact('loker','depts','cabang'));
        // Mengirimkan data loker ke view 'edit'
    }
    public function editLokerstore(Request $request, $id)
{
    // // Validasi input jika diperlukan
    // $request->validate([
    //     // ... Atur aturan validasi jika diperlukan ...
    // ]);

    // Dapatkan data loker berdasarkan ID
    $loker = Loker::find($id);

    // Ubah data loker berdasarkan input form
    $loker->id_cabang = $request->input('id_cabang');
    $loker->id_dept = $request->input('id_dept');
    $loker->desc_job = $request->input('quill_content1');
    $loker->require_job = $request->input('quill_content2');
    $loker->start_date = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
    $loker->end_date = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
    $loker->resume = $request->input('resume', 0);
    $loker->gender = $request->input('gender', 0);
    $loker->date_birth = $request->input('date_birth', 0);
    $loker->country = $request->input('country', 0);
    $loker->profile_image = $request->input('profile_image', 0);
    $loker->cv = $request->input('cv', 0);
    $loker->tac = $request->input('tac', 0);
    $loker->status = 1; // Jika ada data status, sesuaikan dengan input form yang sesuai

    // dd($request);
    // Simpan perubahan ke basis data
    $loker->save();

    return redirect()->back()->with('success', 'Data berhasil diperbarui!');
}


    public function deleteLoker($id)
    {
        $data = Loker::findOrFail($id);
        $data->delete();

        // Setelah menghapus data, Anda dapat melakukan tindakan lainnya,
        // seperti mengirimkan respon atau mengalihkan pengguna ke halaman lain.

        return redirect()->route('loker')->with('success', 'Data berhasil dihapus');
    }

}
