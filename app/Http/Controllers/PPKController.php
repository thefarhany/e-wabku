<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use App\Models\WabkuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PPKController extends Controller
{
    public function dashboard()
    {
        $data = WabkuModel::orderBy('created_at', 'DESC')->get();

        return view('ppk.dashboard', compact('data'));
    }

    public function detail_wabku($id)
    {
        $data = WabkuModel::find($id);

        return view('ppk.dashboard', compact('data'));
    }

    public function validasi_ppk(Request $request, $id)
    {
        $request->validate([
            'status_validasi' => 'required',
            'tgl_validasi_ppk' => 'required|date',
            'ppk_file_pdf' => 'required|mimes:pdf|max:6048', // Validasi file PDF
            'ppk_pajak_file_pdf' => 'mimes:pdf|max:6048', // Validasi file PDF
        ]);

        try {
            $data = WabkuModel::findOrFail($id);

            $filePdf = $request->file('ppk_file_pdf');
            $fileName = date('d-m-Y') . '-' . $filePdf->getClientOriginalName();
            $path = $filePdf->storeAs('pdf-ppk', $fileName, 'public');

            if ($request->hasFile('ppk_pajak_file_pdf')) {
                $filePdfPajak = $request->file('ppk_pajak_file_pdf');
                $fileNamePajak = date('d-m-Y') . '-' . $filePdfPajak->getClientOriginalName();
                $pathPajak = $filePdfPajak->storeAs('pdf-ppk-pajak', $fileNamePajak, 'public');
                $data->pdf_ssp_pajak = $pathPajak;
            }

            $data->pdf_spp = $path;
            $data->validasi_ppk = $request->status_validasi;
            $data->tgl_validasi_ppk = $request->tgl_validasi_ppk;

            if ($data->validasi_bendahara == "Belum Disetujui") {
                $data->validasi_bendahara = "Disetujui";
                $data->tgl_validasi_bendahara = $request->tgl_validasi_ppk;
            }

            $data->save();

            return redirect()->route('dashboard.ppk')->with('success', 'Wabku berhasil divalidasi.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.ppk')->with('error', 'Terjadi kesalahan saat memvalidasi wabku.');
        }
    }

    public function filter_ppk(Request $request)
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

        return view('ppk.dashboard', compact('data'));
    }

    public function referensi()
    {
        $dataRef = ReferensiModel::all();

        return view('ppk.referensi', compact('dataRef'));
    }

    public function monitoring()
    {
        $data = WabkuModel::all();

        return view('ppk.monitoring', compact('data'));
    }

    public function arsip()
    {
        $data = WabkuModel::all();

        return view('ppk.arsip', compact('data'));
    }

    public function password()
    {
        return view('ppk.password');
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

        return redirect()->route('dashboard.ppk')->with('success', 'Password berhasil diperbarui');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
