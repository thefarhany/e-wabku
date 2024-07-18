@extends('master.admin')

@section('title')
<title>Admin | Tambah User</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Data User</h1>
</div>

<form method="POST" action="{{ route('user-proses') }}" enctype="multipart/form-data">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="nip_nrp">NIP/NRP</label>
      <input type="text" class="form-control" id="nip_nrp" name="nip_nrp" required placeholder="NIP/NRP">
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="nama_lengkap">Nama Lengkap</label>
      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required placeholder="Nama Lengkap">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="password">Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Password" required>
        <div class="input-group-prepend">
          <span class="input-group-text" id="toggle-password">
            <i class="fa-solid fa-eye" id="toggle-icon"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="no_ktp">Nomor KTP</label>
      <input type="text" class="form-control" id="no_ktp" name="no_ktp" required placeholder="Nomor KTP">
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="tgl_lahir">Tanggal Lahir</label>
      <input type="date" class="form-control" id="tgl_lahir" required name="tgl_lahir">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="jenis_kelamin">Jenis Kelamin</label>
      <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
        <option>Pilih Jenis Kelamin</option>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="alamat">Alamat</label>
      <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Alamat">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6 mb-3">
      <label for="jabatan">Jabatan</label>
      <input type="text" class="form-control" id="jabatan" name="jabatan" required placeholder="Jabatan">
    </div>
    <div class="form-group col-md-6 mb-3">
      <label for="subsaker">Subsaker</label>
      <select class="custom-select" id="subsaker" name="subsaker">
        <option>Pilih Sub Saker</option>
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
  <div class="form-group">
    <label for="photo_profile">Upload Photo Profile</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="photo_profile" name="photo_profile" onchange="updateFileName('photo_profile')" required>
      <label class="custom-file-label" for="photo_profile" id="photo_profile_label">Upload Image</label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary float-right">Simpan</button>
</form>
@endsection

@section('addons-script')
<script>
  function updateFileName(inputId) {
    var input = document.getElementById(inputId);
    var label = document.getElementById(inputId + '_label');
    if (input.files && input.files.length > 0) {
      label.textContent = input.files[0].name;
    } else {
      label.textContent = 'Upload PDF';
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    var fileInputs = document.querySelectorAll('.custom-file-input');
    Array.prototype.forEach.call(fileInputs, function(input) {
      input.addEventListener('change', function() {
        updateFileName(input.id);
      });
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('toggle-password');
    const toggleIcon = document.getElementById('toggle-icon');

    togglePassword.addEventListener('click', function() {
      // Toggle the type attribute
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      // Toggle the icon
      toggleIcon.classList.toggle('fa-eye');
      toggleIcon.classList.toggle('fa-eye-slash');
    });
  });
</script>
@endsection

<!-- 
Mabekangdam IV/Diponegoro
Denharjasa Int IV/Semarang
Denjasa Ang IV/B Semarang
Denbekang IV/1.B Purwokerto
Denbekang IV/2.B Yogyakarta
Denbekang IV/3.B Salatiga
Denbekang IV/4.B Surakarta
Tepbek IV/1.A Semarang
Tepbek IV/2.A Slawi
Tepbek IV/3.A Magelang

Mabekangdam IV/Diponegoro,Denharjasa Int IV/Semarang,Denjasa Ang IV/B Semarang,Denbekang IV/1.B Purwokerto,Denbekang IV/2.B Yogyakarta,Denbekang IV/3.B Salatiga,Denbekang IV/4.B Surakarta,Tepbek IV/1.A Semarang,Tepbek IV/2.A Slawi,Tepbek IV/3.A Magelang
-->