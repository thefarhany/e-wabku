<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use App\Models\WabkuModel;
use App\Models\UserModel;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BendaharaController extends Controller
{
    public function dashboard()
    {
        $data = WabkuModel::where('perintah_bayar', 'Up')->get();

        return view('bendahara.dashboard', compact('data'));
    }

    public function detail_wabku(Request $request, $id)
    {
        $data = WabkuModel::find($id);

        return view('bendahara.dashboard', compact('data'));
    }

    public function validasi_bendahara(Request $request, $id)
    {
        $request->validate([
            'status_validasi' => 'required',
            'tgl_validasi_bendahara' => 'required'
        ]);

        $data['validasi_bendahara'] = $request->status_validasi;
        $data['tgl_validasi_bendahara'] = $request->tgl_validasi_bendahara;

        WabkuModel::whereId($id)->update($data);

        return redirect()->route('dashboard.bendahara')->with('success', 'Wabku berhasil disetujui.');
    }

    public function sp2d()
    {
        $dataBen = WabkuModel::all();

        return view('bendahara.sp2d', compact('dataBen'));
    }

    public function update_sp2d(Request $request, $id)
    {
        $request->validate([
            'validasi_sp2d' => 'required',
            'no_sp2d' => 'required',
            'tgl_validasi_sp2d' => 'required',
            'pdf_sp2d' => 'required|mimes:pdf|max:6048', // Validasi file PDF
        ]);

        try {
            $filePdf = $request->file('pdf_sp2d');
            $fileName = date('d-m-Y') . '-' . $filePdf->getClientOriginalName();
            $path = $filePdf->storeAs('pdf-sp2d', $fileName, 'public');

            $data['no_sp2d'] = $request->no_sp2d;
            $data['tgl_validasi_sp2d'] = $request->tgl_validasi_sp2d;
            $data['validasi_sp2d'] = $request->validasi_sp2d;
            $data['pdf_sp2d'] = $path;

            WabkuModel::whereId($id)->update($data);

            return redirect()->route('sp2d.bendahara')->with('success', 'SP2D berhasil divalidasi.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.bendahara')->with('error', 'Terjadi kesalahan saat memvalidasi SP2D.');
        }
    }

    public function unduh_wabku($id)
    {
        // Ambil data dari database berdasarkan id
        $data = WabkuModel::findOrFail($id);

        // Daftar file PDF yang akan digabungkan
        $files = [
            $data->pdf_sp2d,
            $data->pdf_ppspm,
            $data->pdf_ssp_pajak,
            $data->pdf_spp,
            $data->pdf_pendukung,
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

        return view('bendahara.referensi', compact('dataRef'));
    }

    public function monitoring()
    {
        $data = WabkuModel::where('perintah_bayar', 'Up')->get();

        return view('bendahara.monitoring', compact('data'));
    }

    public function arsip()
    {
        $data = WabkuModel::all();

        return view('bendahara.arsip', compact('data'));
    }

    public function password()
    {
        return view('bendahara.password');
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

        return redirect()->route('dashboard.bendahara')->with('success', 'Password berhasil diperbarui');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
