@extends('master.admin')

@section('title')
<title>Admin | Edit User</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Edit Data User</h1>
</div>

<form method="POST" action="{{ route('update-user', ['id'=> $dataUser->id]) }}">
  @csrf
  @method('PUT')
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="nip_nrp">NIP/NRP</label>
      <input type="text" class="form-control" id="nip_nrp" name="nip_nrp" value="{{ $dataUser->nip_nrp }}">
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="nama_lengkap">Nama Lengkap</label>
      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $dataUser->nama_lengkap }}">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12 mb-3">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" required value="{{ $dataUser->email }}">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="no_ktp">Nomor KTP</label>
      <input type="text" class="form-control" id="no_ktp" name="no_ktp" required value="{{ $dataUser->no_ktp }}">
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="tgl_lahir">Tanggal Lahir</label>
      <input type="text" class="form-control" id="tgl_lahir" required name="tgl_lahir" value="{{ $dataUser->tgl_lahir }}">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="jenis_kelamin">Jenis Kelamin</label>
      <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin" value="{{ $dataUser->jenis_kelamin }}">
        <option>{{ $dataUser->jenis_kelamin }}</option>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" name="alamat" required value="{{ $dataUser->alamat }}">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="jabatan">Jabatan</label>
      <input type="text" class="form-control" id="jabatan" name="jabatan" required value="{{ $dataUser->jabatan }}">
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="subsaker">Subsaker</label>
      <select class="custom-select" id="subsaker" name="subsaker">
        <option>{{ $dataUser->subsaker }}</option>
        <option value="Admin">Admin</option>
        <option value="Bendahara">Bendahara</option>
        <option value="PPK">PPK</option>
        <option value="PPSPM">PPSPM</option>
        <option value="Kasidalku">Kasidalku</option>
        <option value="Mabekangdam IV/Diponegoro">Mabekangdam IV/Diponegoro</option>
        <option value="Denharjasa Int IV/Semarang">Denharjasa Int IV/Semarang</option>
        <option value="Denjasa Ang IV/B Semarang">Denjasa Ang IV/B Semarang</option>
        <option value="Denbekang IV/1.B Purwokerto">Denbekang IV/1.B Purwokerto</option>
        <option value="Denbekang IV/2.B Yogyakarta">Denbekang IV/2.B Yogyakarta</option>
        <option value="Denbekang IV/3.B Salatiga">Denbekang IV/3.B Salatiga</option>
        <option value="Denbekang IV/4.B Surakarta">Denbekang IV/4.B Surakarta</option>
        <option value="Tepbek IV/1.A Semarang">Tepbek IV/1.A Semarang</option>
        <option value="Tepbek IV/2.A Slawi">Tepbek IV/2.A Slawi</option>
        <option value="Tepbek IV/3.A Magelang">Tepbek IV/3.A Magelang</option>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary float-right">Simpan</button>
</form>
@endsection