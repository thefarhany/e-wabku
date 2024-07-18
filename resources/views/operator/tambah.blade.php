@extends('master.master')

@section('title')
<title>Operator | Tambah Pengajuan Wabku</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Pengajuan Wabku</h1>
</div>

<form action="{{ route('proses-wabku') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-12 mb-3">
      <label for="subsaker">Subsaker</label>
      <input type="text" class="form-control" id="subsaker" name="subsaker" value="{{ Auth::user()->subsaker }}" readonly>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="akun">Akun</label>
      <select class="custom-select" id="akun" name="akun">
        <option default>Pilih Akun</option>
        <option value="51">51</option>
        <option value="52">52</option>
        <option value="53">53</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label for="perintah_bayar">Jenis Perintah Bayar</label>
      <select class="custom-select" id="perintah_bayar" name="perintah_bayar">
        <option default>Pilih Perintah Bayar</option>
        <option value="Up">UP</option>
        <option value="Ls">LS</option>
        <option value="Kontrak">Kontrak</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="program">Program</label>
      <input type="text" class="form-control" id="program" name="program" placeholder="Program" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="npwp">NPWP</label>
      <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP" required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="no_faktur">Nomor Faktur</label>
      <input type="text" class="form-control" id="no_faktur" name="no_faktur" placeholder="Nomor Faktur" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="tgl_faktur">Tanggal Faktur</label>
      <input type="date" class="form-control" id="tgl_faktur" name="tgl_faktur" placeholder="Tanggal Faktur" required>
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-6 mb-3">
      <label for="urai_wabku">Uraian Wabku</label>
      <input type="text" class="form-control" id="urai_wabku" name="urai_wabku" placeholder="Uraian Wabku" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="jml_belanja">Jumlah Belanja</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Rp</div>
        </div>
        <input type="text" class="form-control" id="jml_belanja" name="jml_belanja" placeholder="Jumlah Belanja" required>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="file_pdf" name="file_pdf" onchange="updateFileName('file_pdf')" required>
      <label class="custom-file-label" for="file_pdf" id="file_pdf_label">Upload PDF</label>
    </div>
  </div>
  <button class="btn btn-primary float-right mb-3" type="submit">Ajukan Wabku</button>
</form>
@endsection

@if(session('success'))
<script>
  swal({
    title: "Success!",
    text: "{{ session('success') }}",
    icon: "success",
    button: "OK",
  });
</script>
@endif

@if(session('error'))
<script>
  swal({
    title: "Error!",
    text: "{{ session('error') }}",
    icon: "error",
    button: "OK",
  });
</script>
@endif

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