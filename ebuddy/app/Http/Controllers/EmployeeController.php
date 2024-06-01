<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index', [
            "title" => "Karyawaan",
            "role" => "admin",
            "position" => "admin"
        ]);
    }

    public function create()
    {
        return view('employees.create', [
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
        $employees = User::query()
            ->whereIn('id', $ids)
            ->get();

        return view('employees.edit', [
            "title" => "Edit Data Karyawaan",
            "employees" => $employees,
            "position" => "admin",
            "role" => "admin",
        ]);
    }

    public function delete($id)
    {
        // Cari user berdasarkan ID
        $user = User::find($id);
    
        if ($user) {
            // Hapus data terkait di tabel presences
            Presence::where('user_id', $id)->delete();
    
            // Hapus user
            $user->delete();
    
            return redirect()->route('employees.index')->with('success', 'Data User berhasil dihapus.');
        } else {
            return redirect()->route('employees.index')->with('error', 'Data User tidak ditemukan.');
        }
    }
    
}
