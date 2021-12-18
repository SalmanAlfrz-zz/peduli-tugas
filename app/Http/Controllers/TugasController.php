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

    public function insertTugas(Request $request)
    {
       DB::table('t_tugas')->insert([
        'nama' => $request->judulTugas,
        'deadline' => date('Y-m-d H:i:s', strtotime($request->deadline)),
        'jenis' => $request->jenisTugas,
        'bobot' => $request->bobotTugas,
        'status' => "Belum Selesai",
        'user_id' => "1",
        'created_at' => date('Y-m-d H:i:s', time()),
        'updated_at' => date('Y-m-d H:i:s', time())
       ]);

       return redirect()->back()->with('success', 'Data berhasil ditambah');
    }
}
