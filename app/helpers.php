<?php

use App\Models\cabang;
use App\Models\Departemen;
use App\Models\Skills;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

if (!function_exists(function: 'getNameDept')) {
    function getNameDept($idcabang)
    {

        $arraycabang = Departemen::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->departemen;

        return "$cabang";
    }
}
if (!function_exists(function: 'getNameUser')) {
    function getNameUser($id)
    {

        $arrayname = User::where('id', '=', $id)->first();

        if ($arrayname) {
            // Objek dengan ID yang diberikan ditemukan
            $nama = $arrayname->name;
        } else {
            // Objek dengan ID yang diberikan tidak ditemukan
            $nama = "Nama Tidak Ada";
        }


        return "$nama";
    }
}

if (!function_exists(function: 'getNumberUser')) {
    function getNumberUser($id)
    {

        $arryanumber = User::where('id', '=', $id)->first();

        if ($arryanumber) {
            // Objek dengan ID yang diberikan ditemukan
            $nomor = $arryanumber->nomor;
        } else {
            // Objek dengan ID yang diberikan tidak ditemukan
            $nomor = "nomor Tidak Ada";
        }


        return "$nomor";
    }
}
if (!function_exists(function: 'getNameCabang')) {
    function getNameCabang($idcabang)
    {

        $arraycabang = cabang::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->keterangan;

        return "$cabang";
    }
}
if (!function_exists(function: 'getSingkatanCabang')) {
    function getSingkatanCabang($idcabang)
    {

        $arraycabang = cabang::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->nama_cabang;

        return "$cabang";
    }
}
if (!function_exists(function: 'getPTCabang')) {
    function getPTCabang($idcabang)
    {

        $arraycabang = cabang::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->pt;

        return "$cabang";
    }
}
if (!function_exists(function: 'getAlamatCabang')) {
    function getAlamatCabang($idcabang)
    {

        $arraycabang = cabang::where('id', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->alamat;

        return "$cabang";
    }
}
if (!function_exists('getUserId')) {
    function getUserId()
    {
        $id = Auth::user()->id;
        return $id;
    }

}
if (!function_exists('getUserName')) {
    function getUserName()
    {
        $id = Auth::user()->name;
        return $id;
    }

}
if (!function_exists('getUserIDCabang')) {
    function getUserIDCabang()
    {
        $id = Auth::user()->id_cabang;
        return $id;
    }
}


if (!function_exists('custom_str_limit')) {
    function custom_str_limit($value, $limit = 0, $end = ' <strong style="color: #5e72e4;">Klik untuk detail    .</strong>')
    {
        return Illuminate\Support\Str::limit($value, $limit, $end);
    }
}

if (!function_exists('getNameSkill')) {
    function getNameSkill($id)
    {
        $arrayskill = Skills::where('id', '=', $id)->first();

        if ($arrayskill) {
            return $arrayskill->nama_skill;
        } else {
            return null; // Nilai default jika skill tidak ditemukan
        }
    }
    function formatDateToIndonesian($dateString) {
        // Days of the week in Indonesian
        $days = [
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
        ];

        // Months in Indonesian
        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Parse the date
        $timestamp = strtotime($dateString);
        if ($timestamp === false) {
            return 'Invalid Date';
        }

        // Format the date
        $dayOfWeek = date('w', $timestamp); // 0 (Sunday) to 6 (Saturday)
        $day = date('d', $timestamp);
        $month = date('n', $timestamp); // 1 (January) to 12 (December)
        $year = date('Y', $timestamp);

        // Build the formatted date
        $formattedDate = $days[$dayOfWeek] . ',  ' . $day . ' ' . $months[$month - 1] . ' ' . $year;

        return $formattedDate;
    }

    if (!function_exists('getUmur')) {
        function getUmur($ttl)
        {
            // Menghitung umur berdasarkan tanggal lahir
            $birthDate = Carbon::parse($ttl);
            $currentDate = Carbon::now();
            $umur = $currentDate->diff($birthDate);

            // Mengambil tahun, bulan, dan hari dari hasil perhitungan
            $tahun = $umur->y;
            $bulan = $umur->m;
            $hari = $umur->d;

            // Membuat format umur
            $formatUmur = '';

            if ($tahun > 0) {
                $formatUmur .= $tahun . ' tahun';
            }

            if ($bulan > 0) {
                $formatUmur .= ($formatUmur ? ', ' : '') . $bulan . ' bulan';
            }

            if ($hari > 0) {
                $formatUmur .= ($formatUmur ? ', ' : '') . $hari . ' hari';
            }

            return $formatUmur;
        }
    }

}

