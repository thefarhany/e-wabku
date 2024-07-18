<?php

namespace App\Http\Controllers;

use App\Models\ReferensiModel;
use App\Models\UserModel;
use App\Models\WabkuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function admin()
    {
        $totalWabku = WabkuModel::all()->count();
        $wabkuDisetujui = WabkuModel::where('validasi_sp2d', 'Disetujui')->count();
        $wabkuProses = $totalWabku - $wabkuDisetujui;
        $totalUser = UserModel::all()->count();

        return view('admin.index', compact('totalWabku', 'wabkuDisetujui', 'wabkuProses', 'totalUser'));
    }

    public function user()
    {
        $data = UserModel::all();

        return view('admin.user', compact('data'));
    }

    public function add_user()
    {
        return view('admin.add-user');
    }

    public function user_proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'nip_nrp' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'no_ktp' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'subsaker' => 'required',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo_profile')) {
            $profileImage = $request->file('photo_profile');
            $profileImageName = date('d-m-Y') . '-' . $profileImage->getClientOriginalExtension();
            $profileImagePath = $profileImage->storeAs('photo', $profileImageName, 'public');
        }

        // Simpan data ke database
        $user = new UserModel();
        $user->nip_nrp = $request->nip_nrp;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->no_ktp = $request->no_ktp;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->alamat = $request->alamat;
        $user->jabatan = $request->jabatan;
        $user->subsaker = $request->subsaker;
        if (isset($profileImagePath)) {
            $user->photo_profile = $profileImagePath;
        }
        $user->save();

        return redirect()->route('user.admin', $user->id)->with('success', 'Berhasil Menambahkan User.');
    }

    public function detail_user(Request $request, $nama_lengkap)
    {
        $data = UserModel::find($nama_lengkap);

        return view('admin.user', compact('data'));
    }

    public function edit_user(Request $request, $id)
    {
        $dataUser = UserModel::find($id);

        return view('admin.edit-user', compact('dataUser'));
    }

    public function update_user(Request $request, $id)
    {
        $request->validate([
            'nip_nrp' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required',
            'no_ktp' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'subsaker' => 'required',
        ]);

        try {
            $data['nip_nrp'] = $request->nip_nrp;
            $data['nama_lengkap'] = $request->nama_lengkap;
            $data['email'] = $request->email;
            $data['no_ktp'] = $request->no_ktp;
            $data['tgl_lahir'] = $request->tgl_lahir;
            $data['jenis_kelamin'] = $request->jenis_kelamin;
            $data['alamat'] = $request->alamat;
            $data['jabatan'] = $request->jabatan;
            $data['subsaker'] = $request->subsaker;

            UserModel::whereId($id)->update($data);

            return redirect()->route('user.admin')->with('success', 'Berhasil Menambahkan User.');
        } catch (\Exception $e) {
            return redirect()->route('add-user')->with('error', 'Terjadi Kesalahan Saat Menambahkan User.');
        }
    }

    public function hapus_user($id)
    {
        $data = UserModel::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('user.admin')->with('success', 'User berhasil dihapus');
    }

    public function referensi()
    {
        $data = ReferensiModel::all();

        return view('admin.referensi', compact('data'));
    }

    public function add_referensi()
    {
        return view('admin.add-referensi');
    }

    public function referensi_proses(Request $request)
    {
        $request->validate([
            'referensi' => 'required',
            'referensi_pdf' => 'required|mimes:pdf|max:20048',
        ]);

        try {
            $filePdf = $request->file('referensi_pdf');
            $fileName = date('d-m-Y') . '-' . $filePdf->getClientOriginalName();
            $path = $filePdf->storeAs('referensi', $fileName, 'public');

            $data = [
                'referensi' => $request->referensi,
                'referensi_pdf' => $path,
            ];

            ReferensiModel::create($data);

            return redirect()->route('referensi.admin')->with('success', 'Daftar Referensi Berhasil Ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('add-referensi')->with('error', 'Terjadi Kesalahan Saat Menambahkan Referensi.');
        }
    }

    public function delete_referensi($id)
    {
        $data = ReferensiModel::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->route('referensi.admin')->with('success', 'Referensi berhasil dihapus');
    }

    public function password()
    {
        return view('admin.password');
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

        return redirect()->route('user.admin')->with('success', 'Password berhasil diperbarui');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
