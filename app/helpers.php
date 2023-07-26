<?php

use App\Models\cabang;
use App\Models\Departemen;

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
if (!function_exists(function: 'getNameCabang')) {
    function getNameCabang($idcabang)
    {

        $arraycabang = cabang::where('id_cabang', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->keterangan;

        return "$cabang";
    }
}
if (!function_exists(function: 'getSingkatanCabang')) {
    function getSingkatanCabang($idcabang)
    {

        $arraycabang = cabang::where('id_cabang', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->nama_cabang;

        return "$cabang";
    }
}
if (!function_exists(function: 'getPTCabang')) {
    function getPTCabang($idcabang)
    {

        $arraycabang = cabang::where('id_cabang', '=', "$idcabang")
            ->get()
            ->first();
        $cabang = $arraycabang->pt;

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
if (!function_exists('getUserIDCabang')) {
    function getUserIDCabang()
    {
        $id = Auth::user()->id_cabang;
        return $id;
    }
}
