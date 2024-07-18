@extends('master.admin')

@section('title')
<title>Admin | Tambah Referensi</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Daftar Referensi</h1>
</div>

<form method="POST" action="{{ route('referensi-proses') }}" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="referensi">Referensi</label>
    <input type="text" class="form-control" id="referensi" name="referensi" placeholder="Referensi" required>
  </div>
  <div class="form-group">
    <label for="referensi_pdf">Upload PDF Referensi</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="referensi_pdf" name="referensi_pdf" onchange="updateFileName('referensi_pdf')" required>
      <label class="custom-file-label" for="referensi_pdf" id="referensi_pdf_label">Upload Referensi</label>
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
@endsection