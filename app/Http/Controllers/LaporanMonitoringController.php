<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanMonitoring;
use App\Models\Masterperangkat;

class LaporanMonitoringController extends Controller
{
    public function index()
    {
        $namaperangkats = Masterperangkat::all();
        return view('formuser/form-laporan-monitoring')->with('namaperangkats', $namaperangkats);
    }

    public function addLaporanMonitoring(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'shift' => 'required',
            'divisi' => 'required',
            'perangkat' => 'required',
            'area' => 'required',
            'user' => 'required',
            //'jam' => 'required',
            'ttd1' => 'required',
            'ttd2' => 'required',
        ]);

        // Simpan data laporan monitoring baru ke dalam database
        $tanggal = $request->tanggal;
        $shift = $request->shift;
        $divisi = $request->divisi;
        $perangkat = $request->perangkat;
        $area = $request->area;
        $user = $request->user;
        $jam = $request->jammulai . ' - ' . $request->jamselesai;
        $ttd1 = $request->ttd1;
        $ttd2 = $request->ttd2;

        LaporanMonitoring::addlaporanmonitoring($tanggal, $shift, $divisi, $perangkat, $area, $user, $jam, $ttd1, $ttd2);

        $pesanlaporanmonitoring = "Data telah ditambahkan !";
        return redirect('/form-monitoring-perangkat/' . $perangkat)->with("pesanlaporanmonitoring", $pesanlaporanmonitoring);
        // Redirect ke halaman tertentu jika diperlukan
    }
}
