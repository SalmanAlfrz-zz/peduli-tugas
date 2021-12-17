<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    public function showTugas(){
        $tugas = DB::table('t_tugas')
            ->select(DB::raw('*, (jenis * 15/100 + bobot * 25/100 + datediff(deadline, now()) * 60/100) as priority_value'))
            ->where('user_id', 1)
            ->get();

        return view('dashboard', ['tugas' => $tugas]);
    }
}
