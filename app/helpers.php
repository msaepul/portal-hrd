<?php
use App\Models\cabar;

use Illuminate\Support\Facades\Auth;

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
if (!function_exists('getUserId')) {
    function getUserId()
    {
        $id = Auth::user()->id;
        return $id;
    }
}
