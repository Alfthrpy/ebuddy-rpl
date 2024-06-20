<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public function index(){
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        $role = auth()->user()->role_id == 1 ? 'admin' : 'user';
        
        return view('overtimes.index',[
            'title' => 'Laporan Dinas Luar',
            'role' => $role,
            'position' => $position
        ]);
    }

    public function showReport(Request $request){
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        return view('overtimes.index',[
            'title' => 'Laporan Dinas Luar',
            'role' => "user",
            'position' => $position
        ]);
    }

    public function show(Request $request){
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        $overtime = Overtime::query()->with('creator','approver')->where('id', '=', $request->id)->first();
        return view('overtimes.show',[
            'title' => 'Laporan Dinas Luar',
            'overtime' => $overtime,
            'role' => "user",
            'position' => $position
        ]);
    }

    public function create(){
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        return view('overtimes.create',[
            'title' => 'Laporan Dinas Luar',
            'role' => "user",
            'position' => $position
        ]);
    }

    public function approve(Request $request, Overtime $overtime)
    {
        $overtime->update([
            'status' => 'approved',
            'comment' => $request->input('approver_comment')
        ]);
    
        return redirect()->back()->with('success', 'Laporan telah di-approve.');
    }
    
    public function reject(Request $request, Overtime $overtime)
    {
        $overtime->update([
            'status' => 'rejected',
            'comment' => $request->input('approver_comment')
        ]);
    
        return redirect()->back()->with('success', 'Laporan telah di-reject.');
    }

    public function edit(Request $request){
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        
        $overtime = Overtime::query()->where('id', '=', $request->id)->first()->toArray();
        return view('overtimes.edit',[
            'title' => 'Edit Laporan',
            'role' => "user",
            'position' => $position,
            'overtime' => $overtime
        ]);
    }

    public function delete($id)
    {
        // Cari user berdasarkan ID
        $overtime = Overtime::find($id);
    
        if ($overtime) {
            // Hapus data terkait di tabel presences
            // Hapus user
            $overtime->delete();
    
            return redirect()->route('overtimes.index')->with('success', 'Laporan berhasil dihapus.');
        } else {
            return redirect()->route('overtimes.index')->with('error', 'Laporan tidak ditemukan.');
        }
    }

    public function download(Request $request){
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        $overtime = Overtime::query()->with('creator','approver')->where('id', '=', $request->id)->first();

        $data = [
            'creator' => $overtime->creator->name,
            'objective' => $overtime->objective,
            'place' => $overtime->place,
            'start_date' => $overtime->start_date,
            'end_date' => $overtime->end_date,
            'approver' => $overtime->approver->name,
            'result' => $overtime->result,
            'status' => $overtime->status
        ];
        $pdf = Pdf::loadView('overtimes.pdf', $data);
        return $pdf->stream('laporan_' . $overtime->creator->name . '.pdf');
        
    }
}
