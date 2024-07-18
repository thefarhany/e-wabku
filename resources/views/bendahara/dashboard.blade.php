@extends('master.bendahara')

@section('title')
<title>Bendahara | Dashboard</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="card-body background-light">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th class="align-middle">No</th>
          <th class="align-middle">Subsaker</th>
          <th class="align-middle">Jenis Perintah Bayar</th>
          <th class="align-middle">Uraian Wabku</th>
          <th class="align-middle">Jumlah Belanja</th>
          <th class="align-middle">Tanggal Pengajuan</th>
          <th class="align-middle">Status Validasi</th>
          <th class="align-middle">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $d->subsaker }}</td>
          <td class="align-middle">{{ $d->perintah_bayar }}</td>
          <td class="align-middle">{{ $d->uraian_wabku }}</td>
          <td class="align-middle">Rp {{ $d->jml_belanja }}</td>
          <td class="align-middle">{{ $d->created_at->format('m-d-Y') }}</td>
          <td class="align-middle">
            @if($d->validasi_bendahara == "Ditolak")
            <span class="badge badge-danger">Ditolak</span>
            @elseif($d->validasi_bendahara == "Disetujui")
            <span class="badge badge-success">Disetujui</span>
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            <a href="{{ route('detail-wabku', ['id' => $d->id]) }}" data-toggle="modal" data-target="#detail-modal-{{ $d->id }}"><i class="fa-solid fa-file-circle-check"></i></a>
          </td>
        </tr>

        <!-- Validasi Modal -->
        <div class="modal fade" id="detail-modal-{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $d->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-{{ $d->id }}">{{ $d->program }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('validasi-bendahara', ['id' => $d->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label for="subsaker">Subsaker</label>
                      <input type="text" class="form-control" id="subsaker" name="subsaker" value="{{ $d->subsaker }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="akun">Akun</label>
                      <input type="text" class="form-control" id="akun" name="akun" value="{{ $d->akun }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="perintah_bayar">Jenis Perintah Bayar</label>
                      <input type="text" class="form-control" id="perintah_bayar" name="perintah_bayar" value="{{ $d->perintah_bayar }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="uraian_wabku">Uraian Wabku</label>
                      <input type="text" class="form-control" id="uraian_wabku" name="uraian_wabku" value="{{ $d->uraian_wabku }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="created_at">Tanggal Pengajuan</label>
                      <input type="text" class="form-control" id="created_at" name="created_at" value="{{ date('d-m-Y', strtotime($d->created_at)) }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="no_faktur">Nomor Faktur</label>
                      <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="{{ $d->no_faktur }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="tgl_faktur">Tanggal Faktur</label>
                      <input type="text" class="form-control" id="tgl_faktur" name="tgl_faktur" value="{{ date('d-m-Y', strtotime($d->tgl_faktur)) }}" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="file_pdf">Lampiran Wabku</label>
                    @if($d->pdf_pendukung)
                    <div>
                      <a href="{{ Storage::url($d->pdf_pendukung) }}" target="_blank" class="btn btn-sm btn-block btn-success">Lihat PDF</a>
                    </div>
                    @else
                    <div class="alert alert-warning">Tidak ada bukti PDF yang diunggah</div>
                    @endif
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="status_validasi">Status Validasi</label>
                      @if($d->validasi_bendahara == "Disetujui")
                      <input type="text" class="form-control" id="status_validasi" name="status_validasi" value="{{ $d->validasi_bendahara }}" disabled>
                      @else
                      <select class="custom-select" id="status_validasi" name="status_validasi">
                        <option value="">Pilih Validasi</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                      </select>
                      @endif
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="tgl_validasi_bendahara">Tanggal Validasi</label>
                      @if($d->validasi_bendahara == "Disetujui")
                      <input type="text" class="form-control" id="tgl_validasi_bendahara" name="tgl_validasi_bendahara" value="{{ date('d-m-Y', strtotime($d->tgl_validasi_bendahara)) }}" disabled>
                      @else
                      <input type="date" class="form-control" id="tgl_validasi_bendahara" name="tgl_validasi_bendahara" placeholder="Pilih Tanggal Validasi" required>
                      @endif
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                  @if($d->validasi_bendahara == "Disetujui")
                  <button class="btn btn-success float-right mb-3" type="submit" disabled>Simpan</button>
                  @else
                  <button class="btn btn-success float-right mb-3" type="submit">Simpan</button>
                  @endif
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Validasi Modal -->
        @endforeach
      </tbody>
    </table>
  </div>
</div>
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