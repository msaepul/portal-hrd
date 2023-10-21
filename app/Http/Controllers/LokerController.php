<?php

namespace App\Http\Controllers;

use App\Models\cabang;
use App\Models\Departemen;
use App\Models\Loker;
use App\Models\User;
use App\Models\Skills;
use Illuminate\Support\Facades\DB;
use App\Models\Province;
use App\Models\District;
use App\Models\Regency;
use App\Models\Apply;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use RarArchive;


class LokerController extends Controller
{
    public function index()
    {

        $cabang = cabang::where('status', '=', '1')->get();
        if (Auth::check()) {
            // Jika pengguna sudah login
            $loker = DB::table('tb_loker')->where('status','=',1) ->where('end_date', '>=', now())
                ->whereNotIn('id_loker', function($query) {
                    $query->select('id_loker')->from('tb_apply')
                        ->where('id_user', Auth::user()->id);
                })
                ->get();
        } else {
            // Jika pengguna belum login
            $loker = Loker::where('end_date', '>=', now())->where('status','=',1)->get();

        }

        $user= Auth::user();

        foreach ($loker as $l) {
            $idSkillArray = explode(',', $l->id_skill);
            $l->id_skill = $idSkillArray; // Simpan hasil ekstraksi sebagai array di model Loker
        }
        return view('landing', compact('cabang', 'loker','user'));
    }
    public function listapply()
    {

        $cabang = cabang::where('status', '=', '1')->get();
        if (Auth::check()) {
            // Jika pengguna sudah login
            $loker = DB::table('tb_loker')
                ->whereIn('id_loker', function($query) {
                    $query->select('id_loker')->from('tb_apply')
                        ->where('id_user', Auth::user()->id);
                })
                ->get();
        } else {
            // Jika pengguna belum login
            $loker = Loker::all();
        }

        $user= Auth::user();

        foreach ($loker as $l) {
            $idSkillArray = explode(',', $l->id_skill);
            $l->id_skill = $idSkillArray; // Simpan hasil ekstraksi sebagai array di model Loker
        }
        return view('landing.listlokerapply', compact('cabang', 'loker','user'));
    }

    public function detailLandingLoker($id)
    {
        $loker = Loker::findOrFail($id);
        $idSkillArray = explode(',', $loker->id_skill);
        $loker->id_skill = $idSkillArray; // Simpan hasil ekstraksi sebagai array di model Loker

        return view('landing.lokerlandingdetail', compact('loker'));
    }
    public function applyLandingLoker($id)
    {
        $loker = Loker::findOrFail($id);
        $provinsi = Province::all();
        $idSkillArray = explode(',', $loker->id_skill);
        $loker->id_skill = $idSkillArray; // Simpan hasil ekstraksi sebagai array di model Loker
        $user= Auth::user();
        return view('landing.lokerapply', compact('loker','provinsi','user'));
    }

    public function ApplyLokerStore(Request $request)
    {
        $request->validate([
            // 'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'cv' => 'file|mimes:jpeg,png,jpg,gif,pdf,word|max:2048',
            // 'kartu_keluarga' => 'file|mimes:jpeg,png,jpg,gif,pdf,word|max:2048',
            // 'ktp' => 'file|mimes:jpeg,png,jpg,gif,pdf,word|max:2048',
            // 'vaksin' => 'file|mimes:jpeg,png,jpg,gif,pdf,word|max:2048',


        ]);

        $photoName = "-";
        $kkName = "-";
        $vaksinName= "-";
        $ktpName = "-";
        $fileName = "-";
        $id_loker = $request->input('idloker');
        $id_user = auth::user()->id;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = $id_user.'- pasphoto'. '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/' . $id_loker . '/photo'), $photoName);
        }

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $fileName =  $id_user.'- cv'  . '.' . $file->getClientOriginalExtension(); // Menggunakan $file
            $file->move(public_path('uploads/' . $id_loker . '/cv'), $fileName); // Menggunakan $file
        }
        if ($request->hasFile('kartu_keluarga')) {
            $file = $request->file('kartu_keluarga');
            $kkName =  $id_user.'- KK'  . '.' . $file->getClientOriginalExtension(); // Menggunakan $file
            $file->move(public_path('uploads/' . $id_loker . '/kartu_keluarga'), $kkName); // Menggunakan $file
        }
        if ($request->hasFile('ktp')) {
            $file = $request->file('ktp');
            $ktpName =  $id_user.'- KTP'  . '.' . $file->getClientOriginalExtension(); // Menggunakan $file
            $file->move(public_path('uploads/' . $id_loker . '/ktp'), $ktpName); // Menggunakan $file
        }
        if ($request->hasFile('vaksin')) {
            $file = $request->file('vaksin');
            $vaksinName =  $id_user.'- vaksin'  . '.' . $file->getClientOriginalExtension(); // Menggunakan $file
            $file->move(public_path('uploads/' . $id_loker . '/vaksin'), $vaksinName); // Menggunakan $file
        }

        DB::table('tb_apply')->insert([
            'id_user' => auth()->user()->id,
            'id_loker' => $id_loker,
            'id_cabang' => $request->input('cabang'),
            'gender' => $request->input('jenis_kelamin'),
            'birth' => $request->input('birth'),
            'id_provinsi' => $request->input('provinsi'),
            'id_kota' => $request->input('kota'),
            'id_kecamatan' => $request->input('kecamatan'),
            'cover' => $request->input('cover'),
            'photo' => $photoName,
            'cv' => $fileName,
            'kartu_keluarga' => $kkName,
            'ktp' => $ktpName,
            'vaksin' => $vaksinName,
            'status' => 0,
        ]);

        return redirect()->route('index')->with('success', 'Lamaran Berhasil dibuat');
    }

    public function getkota(request $request){
        $id_provinsi = $request->id_provinsi;

        $kotas = Regency::where('province_id',$id_provinsi)->get();
        $option = "<option disabled selected>Pilih Kota</option>";
        foreach ($kotas as $kota){
            $option.="<option value='$kota->id'> $kota->name </option>";
        }
        echo $option; //respone ke View loker apply (get data kota ketika select provinsi)

    }
    public function getkecamatan(request $request){
        $id_kota = $request->id_kota;

        $kecamatans = District::where('regency_id',$id_kota)->get();
        $option = "<option disabled selected>Pilih Kecamatan</option>";
        foreach ($kecamatans as $kecamatan){
            $option.="<option value='$kecamatan->id'> $kecamatan->name </option>";
        }
        echo $option; //respone ke View loker apply (get data kecamatan ketika select kota)


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
        $skills = Skills::where('status', '=', '1')->get();
        return view('loker.lokerdetail', compact('cabang', 'loker', 'skills'));
    }

    public function addLoker()
    {
        $depts = Departemen::all();
        $cabang = cabang::all();
        $skills = Skills::all();
        return view('loker.addloker', compact('depts','cabang','skills'));
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
        $kartu_keluarga = $request->input('kartu_keluarga', 0); // Mengambil nilai dari input checkbox7 atau kembalikan 0 jika tidak ada
        $ktp = $request->input('ktp', 0); // Mengambil nilai dari input checkbox7 atau kembalikan 0 jika tidak ada
        $vaksin = $request->input('vaksin', 0); // Mengambil nilai dari input checkbox7 atau kembalikan 0 jika tidak ada
        $generate = Loker::generateNomor();
        $selectedOptions = $request->input('id_skill');
        $joinedOptions = implode(',', $selectedOptions);

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
            'id_skill'=>$joinedOptions,

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
    $loker->kartu_keluarga = $request->input('kartu_keluarga', 0);
    $loker->vaksin = $request->input('vaksin', 0);
    $loker->ktp = $request->input('ktp', 0);
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

    public function showListApply()
    {
        $tanggal = "1995-10-10";
        $apply=Apply::all();
        return view('loker.listapply',compact('apply','tanggal'));
    }

    public function compressAndDownload(Request $request,$id)
{
    $loker = Apply::find($id);

    $zip = new ZipArchive;
    $zipFileName = 'Data - ' . getNameUser($loker->id_user) . '.zip';
    $zipFilePath = public_path($zipFileName);

    $filesAdded = [];

    if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
        // Define file paths
        $cvPath = public_path("uploads/{$loker->id_loker}/cv/{$loker->cv}");
        $photoPath = public_path("uploads/{$loker->id_loker}/photo/{$loker->photo}");
        $vaksinPath = public_path("uploads/{$loker->id_loker}/vaksin/{$loker->vaksin}");
        $kkPath = public_path("uploads/{$loker->id_loker}/kk/{$loker->kartu_keluarga}");
        $ktpPath = public_path("uploads/{$loker->id_loker}/ktp/{$loker->ktp}");

        // Check if each file exists before adding it to the ZIP archive
        if (file_exists($cvPath)) {
            $zip->addFile($cvPath, $loker->cv);
            $filesAdded[] = $cvPath;
        }
        if (file_exists($photoPath)) {
            $zip->addFile($photoPath, $loker->photo);
            $filesAdded[] = $photoPath;
        }
        if (file_exists($vaksinPath)) {
            $zip->addFile($vaksinPath, $loker->vaksin);
            $filesAdded[] = $vaksinPath;
        }
        if (file_exists($kkPath)) {
            $zip->addFile($kkPath, $loker->kartu_keluarga);
            $filesAdded[] = $kkPath;
        }
        if (file_exists($ktpPath)) {
            $zip->addFile($ktpPath, $loker->ktp);
            $filesAdded[] = $ktpPath;
        }

        $zip->close();
    }

    if (count($filesAdded) === 0) {
        // No files were added to the ZIP archive, handle this situation (e.g., return an error response).
        // You may want to delete the empty ZIP file as well.
    } else {
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

}

}
