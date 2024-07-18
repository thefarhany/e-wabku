<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use App\Models\UserModel;
use App\Models\WabkuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OperatorController extends Controller
{
    public function dashboard()
    {
        $totalWabku = WabkuModel::all()->count();
        $wabkuDisetujui = WabkuModel::where('validasi_sp2d', 'Disetujui')->count();
        $wabkuProses = $totalWabku - $wabkuDisetujui;
        $totalUser = UserModel::all()->count();

        return view('operator.dashboard', compact('totalWabku', 'wabkuDisetujui', 'wabkuProses', 'totalUser'));
    }

    public function rekam()
    {
        $user = Auth::user()->subsaker;
        $data = WabkuModel::where('subsaker', $user)->get();

        return view('operator.rekam', compact('data'));
    }

    public function tambah_wabku()
    {
        return view('operator.tambah');
    }

    public function proses_wabku(Request $request)
    {
        $request->validate([
            'subsaker' => 'required',
            'akun' => 'required',
            'perintah_bayar' => 'required',
            'program' => 'required',
            'npwp' => 'required',
            'no_faktur' => 'required',
            'tgl_faktur' => 'required|date',
            'urai_wabku' => 'required',
            'jml_belanja' => 'required',
            'file_pdf' => 'required|mimes:pdf', // Validasi file PDF
        ]);

        try {
            $filePdf = $request->file('file_pdf');
            $fileName = date('d-m-Y') . '-' . $filePdf->getClientOriginalName();
            $path = $filePdf->storeAs('pdf', $fileName, 'public');

            $data['subsaker'] = $request->subsaker;
            $data['akun'] = $request->akun;
            $data['perintah_bayar'] = $request->perintah_bayar;
            $data['program'] = $request->program;
            $data['npwp'] = $request->npwp;
            $data['no_faktur'] = $request->no_faktur;
            $data['tgl_faktur'] = $request->tgl_faktur;
            $data['uraian_wabku'] = $request->urai_wabku;
            $data['jml_belanja'] = $request->jml_belanja;
            $data['pdf_pendukung'] = $path;

            WabkuModel::create($data);

            return redirect()->route('rekam.operator')->with('success', 'Wabku berhasil diajukan.');
        } catch (\Exception $e) {
            return redirect()->route('rekam.operator')->with('error', 'Terjadi kesalahan saat menambahkan wabku.');
        }
    }

    public function detail_wabku(Request $request, $program)
    {
        $data = WabkuModel::find($program);

        return view('operator.rekam', [compact('data')]);
    }

    public function download_wabku($id)
    {
        $wabku = WabkuModel::findOrFail($id);
        $path = $wabku->pdf_pendukung;

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path);
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function delete($id)
    {
        $data = WabkuModel::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('rekam.operator')->with('success', 'Wabku berhasil dihapus');
    }

    public function referensi()
    {
        $dataRef = ReferensiModel::all();

        return view('operator.referensi', compact('dataRef'));
    }

    public function kontak()
    {
        return view('operator.kontak');
    }

    public function monitoring()
    {
        $user = Auth::user()->subsaker;
        $data = WabkuModel::where('subsaker', $user)->get();

        return view('operator.monitoring', compact('data'));
    }

    public function video()
    {
        return view('operator.video');
    }

    public function arsip()
    {
        $user = Auth::user()->subsaker;
        $data = WabkuModel::where('subsaker', $user)->get();

        return view('operator.arsip', compact('data'));
    }

    public function password()
    {
        return view('operator.password');
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

        return redirect()->route('dashboard.operator')->with('success', 'Password berhasil diperbarui');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
