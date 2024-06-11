<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(){
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        $role = auth()->user()->role_id == 1 ? 'admin' : 'user';
        
        return view('positions.index',[
            'title' => 'Posisi/Jabatan',
            'role' => $role,
            'position' => $position
        ]);
    }

    public function create()
    {
        return view('positions.create', [
            "title" => "Tambah Data Karyawaan",
            "position" => "admin",
            "role" => "admin",
        ]);
    }

    public function edit()
    {
        $ids = request('id');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);

        // ambil data user yang hanya memiliki User::USER_ROLE_ID / role untuk karyawaan
        $positions = Position::query()
            ->whereIn('id', $ids)
            ->get();

        return view('positions.edit', [
            "title" => "Edit Data posisi",
            "positions" => $positions,
            "position" => "admin",
            "role" => "admin",
        ]);
    }

    public function delete(){
        $ids = request('id');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);
        // Cek apakah ada user yang menggunakan position tersebut
        $usersWithPosition = User::where('position_id', $ids)->count();

        if ($usersWithPosition > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus posisi karena ada pengguna yang menggunakan posisi tersebut.');
        }

        // Jika tidak ada user yang menggunakan position, hapus data position
        $position = Position::find($ids);

        if ($position) {
            // Menggunakan metode destroy() untuk menghapus entitas berdasarkan kunci primer
            Position::destroy($ids);
            return redirect()->back()->with('success', 'Posisi berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Posisi tidak ditemukan.');
        }
    }


}
