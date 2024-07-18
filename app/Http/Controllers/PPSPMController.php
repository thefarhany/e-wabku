<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use App\Models\WabkuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PPSPMController extends Controller
{
    public function dashboard()
    {
        $data = WabkuModel::all();

        return view('ppspm.dashboard', compact('data'));
    }

    public function detail_wabku(Request $request, $id)
    {
        $data = WabkuModel::find($id);

        return view('ppspm.dashboard', compact('data'));
    }

    public function validasi_ppspm(Request $request, $id)
    {
        $request->validate([
            'status_validasi' => 'required',
            'tgl_validasi_ppspm' => 'required|date',
            'ppspm_file_pdf' => 'required|mimes:pdf|max:6048', // Validasi file PDF
        ]);

        try {
            $filePdf = $request->file('ppspm_file_pdf');
            $fileName = date('Y-m-d') . '-' . $filePdf->getClientOriginalName();
            $path = $filePdf->storeAs('pdf-spm', $fileName, 'public');

            $data['pdf_ppspm'] = $path;
            $data['validasi_ppspm'] = $request->status_validasi;
            $data['tgl_validasi_ppspm'] = $request->tgl_validasi_ppspm;

            WabkuModel::whereId($id)->update($data);

            return redirect()->route('dashboard.ppspm')->with('success', 'Wabku berhasil divalidasi.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.ppspm')->with('error', 'Terjadi kesalahan saat memvalidasi wabku.');
        }
    }

    public function filter_ppspm(Request $request)
    {
        $query = WabkuModel::query();

        if ($request->filled('subsaker') && $request->subsaker !== '') {
            $query->where('subsaker', $request->subsaker);
        }

        if ($request->filled('perintah_bayar') && $request->perintah_bayar !== '') {
            $query->where('perintah_bayar', $request->perintah_bayar);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $data = $query->get();

        return view('ppspm.dashboard', compact('data'));
    }

    public function referensi()
    {
        $dataRef = ReferensiModel::all();

        return view('ppspm.referensi', compact('dataRef'));
    }

    public function monitoring()
    {
        $data = WabkuModel::all();

        return view('ppspm.monitoring', compact('data'));
    }

    public function arsip()
    {
        $data = WabkuModel::all();

        return view('ppspm.arsip', compact('data'));
    }

    public function password()
    {
        return view('ppspm.password');
    }

    public function ganti_password(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        /** @var \App\Models\UserModel $user **/
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboard.ppspm')->with('success', 'Password berhasil diperbarui');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
