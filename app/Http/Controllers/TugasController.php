<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TugasController extends Controller
{
    public function showTugas(){
        $tugas = DB::table('t_tugas')
            ->select(DB::raw('*, (jenis * 15/100 + bobot * 25/100 + (ABS(timestampdiff(minute, deadline, now()) / 1440) * 60/100)) as priority_value'))
            ->orderBy('priority_value', 'desc')
            ->where('user_id', 1)
            ->get();

        return view('dashboard', ['tugas' => $tugas]);
    }

    public function removeTugas($id)
    {
        // DB::table('t_tugas')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
