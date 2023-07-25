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
            'profile_imge'=>$profile_image,
            'cv'=>$cv,
            'tac'=>$tac,
            'profile_image'=>$pf,
            'status'=>1

        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');

    }

}
