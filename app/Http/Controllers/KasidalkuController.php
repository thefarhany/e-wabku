<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use App\Models\WabkuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Tcpdf\Fpdi;

class KasidalkuController extends Controller
{
    public function dashboard()
    {
        $data = WabkuModel::all();

        return view('kasidalku.dashboard', compact('data'));
    }

    public function unduh_pdf($id)
    {
        // Ambil data dari database berdasarkan id
        $data = WabkuModel::findOrFail($id);

        // Daftar file PDF yang akan digabungkan
        $files = [
            $data->pdf_pendukung,
            $data->pdf_spp,
            $data->pdf_ssp_pajak,
            $data->pdf_ppspm,
            $data->pdf_sp2d,
        ];

        // Inisialisasi TCPDF dengan FPDI
        $pdf = new Fpdi();

        // Tambahkan file PDF jika ada
        foreach ($files as $file) {
            if ($file) {
                // Pastikan untuk menggunakan jalur yang benar di storage
                $filePath = storage_path('app/public/' . $file);
                if (file_exists($filePath)) {
                    try {
                        $pageCount = $pdf->setSourceFile($filePath);
                        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                            $templateId = $pdf->importPage($pageNo);
                            $size = $pdf->getTemplateSize($templateId);

                            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                            $pdf->useTemplate($templateId);
                        }
                    } catch (\Exception $e) {
                        // Handle error if needed
                    }
                } else {
                    // Handle file not existing if needed
                }
            }
        }

        // Tentukan jalur keluaran
        $outputFileName = date('d-m-Y') . '-' . $data->uraian_wabku . '.pdf';
        $outputPath = storage_path('app/public/arsip/' . $outputFileName);

        // Gabungkan dan simpan PDF
        $pdf->Output($outputPath, 'F');

        $data->pdf_arsip = 'public/arsip/' . $outputFileName;
        $data->save();

        // Kembalikan file PDF yang digabungkan sebagai respons
        return Storage::download('public/arsip/' . $outputFileName);
    }

    public function referensi()
    {
        $dataRef = ReferensiModel::all();

        return view('kasidalku.referensi', compact('dataRef'));
    }

    public function monitoring()
    {
        $data = WabkuModel::all();

        return view('kasidalku.monitoring', compact('data'));
    }

    public function arsip()
    {
        $data = WabkuModel::all();

        return view('kasidalku.arsip', compact('data'));
    }

    public function password()
    {
        return view('kasidalku.password');
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

        return redirect()->route('dashboard.kasidalku')->with('success', 'Password berhasil diperbarui');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
