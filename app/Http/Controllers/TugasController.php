<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TugasController extends Controller
{
    public function showTugas(){
        $tugas = DB::table('t_tugas')
            ->select(DB::raw('*, jenis * 15/100 + bobot * 25/100 + (timestampdiff(minute, now(), deadline) / 1440) * 60/100 as priority_value'))
            ->orderBy('priority_value', 'asc')
            ->where('user_id', 1)
            ->get();

        return view('dashboard', ['tugas' => $tugas]);
    }

    public function showTugasWithDone(){
        $tugas = DB::table('t_tugas')
            ->select(DB::raw('*, jenis * 15/100 + bobot * 25/100 + (timestampdiff(minute, now(), deadline) / 1440) * 60/100 as priority_value'))
            ->orderBy('priority_value', 'asc')
            ->orderBy('status', 'desc')
            ->where('user_id', 1)
            ->get();

        return view('dashboard', ['tugas' => $tugas]);
    }

    public function removeTugas($id)
    {
        DB::table('t_tugas')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function insertTugas(Request $request)
    {
        $deadline = date('Y-m-d', strtotime($request->deadlineDate)) . " " . date('H:i:s', strtotime($request->deadlineTime));
       DB::table('t_tugas')->insert([
        'nama' => $request->judulTugas,
        // 'deadline' => date('Y-m-d H:i:s', strtotime($request->deadline)),
        'deadline' => $deadline,
        'jenis' => $request->jenisTugas,
        'bobot' => $request->bobotTugas,
        'status' => "Belum Selesai",
        'user_id' => "1",
        'created_at' => date('Y-m-d H:i:s', time()),
        'updated_at' => date('Y-m-d H:i:s', time())
       ]);

       return redirect()->back()->with('success', 'Data berhasil ditambah');
    }

    public function updateTugas(Request $request, $id)
    {
        DB::table('t_tugas')->where('id', $id)->update([
            'nama' => $request->judulTugas,
            'deadline' => date('Y-m-d H:i:s', strtotime($request->deadline)),
            'jenis' => $request->jenisTugas,
            'bobot' => $request->bobotTugas,
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function selesaiTugas($id)
    {
        DB::table('t_tugas')->where('id', $id)->update([
            'status' => "Selesai",
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);

        return redirect()->back();
    }

    public function batalSelesaiTugas($id)
    {
        DB::table('t_tugas')->where('id', $id)->update([
            'status' => "Belum Selesai",
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);

        return redirect()->back();
    }
}
