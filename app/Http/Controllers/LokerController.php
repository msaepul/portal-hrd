<?php

namespace App\Http\Controllers;

use App\Models\cabang;
use App\Models\Loker;
use Illuminate\Http\Request;

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
        // $depts = Departemen::all();
        return view('loker.list');
    }
    public function lokerdetail()
    {
        $cabang = cabang::all();
        $loker = Loker::where('status', '=', '1')->get();
        return view('loker.lokerdetail', compact('cabang', 'loker'));
    }

    public function addLoker()
    {
        // $depts = Departemen::all();
        return view('loker.addloker');
    }
}
