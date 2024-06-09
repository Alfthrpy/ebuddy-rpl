<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Storage;
use App\Models\Letter;

class LetterController extends Controller
{
    

    public function show($id)
    {
        // Ambil template dari database berdasarkan id
        $letter = Letter::findOrFail($id);
    
        // Mengambil data template terkait
        $template = $letter->template;
    
        // Array of days and months in Indonesian
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        
        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];
    
        // Format the date to "Senin, 12 Februari 2023"
        $date_out = strtotime($letter->date_out);
        $day = $days[date('l', $date_out)];
        $date = date('d', $date_out);
        $month = $months[date('F', $date_out)];
        $year = date('Y', $date_out);
        $formatted_date = "$day, $date $month $year";
        
        // Data dummy untuk menggantikan variabel dalam template
        $data = [
            'date_out' => $formatted_date,
            'no_letter' => $letter->no_letter,
            'attachment' => $letter->attachment,
            'subject' => $letter->subject,
            'destination' => $letter->destination,
            'destination_position' => $letter->destination_position,
            'content' => $letter->content,
            'wm_creator' => $letter->wm_creator ? Storage::url($letter->wm_creator) : '', // Check if wm_creator exists
            'creator_name' => $letter->creator->name,
            'creator_position' => $letter->creator->position->name,
            'creator_id' => $letter->creator->id,
            'wm_approver' => $letter->wm_approver ? Storage::url($letter->wm_approver) : '', // Check if wm_approver exists
            'approver_name' => $letter->approver->name,
            'approver_position' => $letter->approver->position->name,
            'approver_id' => $letter->approver->id,
        ];
    
        // Gantikan variabel dalam template dengan data dummy
        $template_content = $template->template;
        foreach ($data as $key => $value) {
            $template_content = str_replace('{{' . $key . '}}', $value, $template_content);
        }
    
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        $role = auth()->user()->role_id == 1 ? 'admin' : 'user';
    
        // Tampilkan hasil template dengan konten yang sudah digantikan
        return view('letters.show', [
            'content' => $template_content,
            'title' => 'Laporan Dinas Luar',
            'role' => $role,
            'position' => $position,
            'letter' => $letter
        ]);
    }
    

    public function index()
    {
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        $role = auth()->user()->role_id == 1 ? 'admin' : 'user';

        return view('letters.index', [
            'title' => 'Surat-Surat',
            'role' => $role,
            'position' => $position,
        ]);
    }

    public function showLetter()
    {
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        $role = auth()->user()->role_id == 1 ? 'admin' : 'user';

        return view('letters.index', [
            'title' => 'Surat-Surat',
            'role' => $role,
            'position' => $position,
        ]);
    }

    public function create()
    {
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        return view('letters.create', [
            'title' => 'Laporan Dinas Luar',
            'role' => 'user',
            'position' => $position,
        ]);
    }

    public function approve(Request $request, $id){
        $request->validate([
            'approver_comment' => 'required|string',
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $letter = Letter::findOrFail($id);

        if (auth()->user()->id == $letter->user_id_approver) {
            // Handle file upload
            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')->store('public/signatures');
                $letter->wm_approver = $signaturePath;
            }

            $letter->comment = $request->approver_comment;
            $letter->status = 'approved';
            $letter->save();

            return redirect()->back()->with('success', 'Surat berhasil disetujui!');
        }

    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'approver_comment' => 'required|string',
        ]);

        $letter = Letter::findOrFail($id);

        if (auth()->user()->id == $letter->user_id_approver) {
            $letter->comment = $request->approver_comment;
            $letter->status = 'rejected';
            $letter->save();

            return redirect()->back()->with('success', 'Surat berhasil ditolak!');
        }

        return redirect()->back()->with('error', 'Anda tidak berhak menolak laporan ini.');
    }

    public function edit(Request $request){
        $position = auth()->user()->role_id == 2 ? 'pejabat' : 'pegawai';
        
        $letter = Letter::query()->where('id', '=', $request->id)->first()->toArray();
        return view('letters.edit',[
            'title' => 'Edit Laporan',
            'role' => "user",
            'position' => $position,
            'letter' => $letter
        ]);
    }

    public function delete($id)
    {
        // Cari user berdasarkan ID
        $letter = Letter::find($id);
    
        if ($letter) {
            $letter->delete();
    
            return redirect()->route('letters.index')->with('success', 'Surat berhasil dihapus.');
        } else {
            return redirect()->route('letters.index')->with('error', 'Surat tidak ditemukan.');
        }
    }
}
