@extends('master.bendahara')

@section('title')
<title>Bendahara | Input SP2D</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Input SP2D</h1>
</div>

<div class="card-body background-light">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th class="align-middle">No</th>
          <th class="align-middle">Akun</th>
          <th class="align-middle">Jenis Perintah Bayar</th>
          <th class="align-middle">Uraian Wabku</th>
          <th class="align-middle">Jumlah Belanja</th>
          <th class="align-middle">Tanggal Pengajuan</th>
          <th class="align-middle">Status SP2D</th>
          <th class="align-middle">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($dataBen as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $d->akun }}</td>
          <td class="align-middle">{{ $d->perintah_bayar }}</td>
          <td class="align-middle">{{ $d->uraian_wabku }}</td>
          <td class="align-middle">{{ $d->jml_belanja }}</td>
          <td class="align-middle">{{ $d->created_at->format('d-m-Y') }}</td>
          <td class="align-middle">
            @if($d->validasi_sp2d == "Disetujui")
            <span class="badge badge-success">Dicatat</span>
            @elseif($d->validasi_sp2d == "Ditolak")
            <span class="badge badge-danger">Belum Dicatat</span>
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            <a href="{{ route('detail-wabku', ['id' => $d->id]) }}" data-toggle="modal" data-target="#detail-modal-{{ $d->id }}"><i class="fa-solid fa-file-circle-check"></i></a>
          </td>
        </tr>

        <!-- Validasi Modal -->
        <div class="modal fade" id="detail-modal-{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $d->program }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('update-sp2d', ['id' => $d->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
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
                      <label for="uraian_wabku-{{ $d->id }}">Uraian Wabku</label>
                      <input type="text" class="form-control" id="uraian_wabku-{{ $d->id }}" name="uraian_wabku" value="{{ $d->uraian_wabku }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="created_at-{{ $d->id }}">Tanggal Pengajuan</label>
                      <input type="text" class="form-control" id="created_at-{{ $d->id }}" name="created_at" value="{{ date('d-m-Y', strtotime($d->created_at)) }}" disabled>
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
                  <hr>
                  <h5 class="font-weight-bold">Persetujuan</h5>
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="status_validasi">Bendahara</label>
                      <input type="text" class="form-control" id="status_validasi" name="status_validasi" value="{{ $d->validasi_bendahara }}" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validasi_ppk">PPK</label>
                      <input type="text" class="form-control" id="validasi_ppk" name="validasi_ppk" value="{{ $d->validasi_ppk }}" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validasi_ppspm">PPSPM</label>
                      <input type="text" class="form-control" id="validasi_ppspm" name="validasi_ppspm" value="{{ $d->validasi_ppspm }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="validasi_sp2d">Status SP2D</label>
                      @if($d->validasi_bendahara == "Ditolak" || $d->validasi_bendahara == "Belum Disetujui")
                      <input type="text" class="form-control" id="validasi_sp2d" name="validasi_sp2d" placeholder="Validasi SP2D" disabled>
                      @elseif($d->validasi_ppk == "Ditolak" || $d->validasi_ppk == "Belum Disetujui")
                      <input type="text" class="form-control" id="validasi_sp2d" name="validasi_sp2d" placeholder="Validasi SP2D" disabled>
                      @elseif($d->validasi_ppspm == "Ditolak" || $d->validasi_ppspm == "Belum Disetujui")
                      <input type="text" class="form-control" id="validasi_sp2d" name="validasi_sp2d" placeholder="Validasi SP2D" disabled>
                      @else
                      <select class="custom-select" id="validasi_sp2d" name="validasi_sp2d">
                        <option value="">Pilih Status</option>
                        <option value="Disetujui">Dicatat</option>
                        <option value="Ditolak">Belum Dicatat</option>
                      </select>
                      @endif
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="pdf_sp2d">PDF SP2D</label>
                      @if($d->validasi_bendahara == "Ditolak" || $d->validasi_bendahara == "Belum Disetujui")
                      <input type="text" class="form-control" id="pdf_sp2d" name="pdf_sp2d" placeholder="Lampiran SP2D" disabled>
                      @elseif($d->validasi_ppk == "Ditolak" || $d->validasi_ppk == "Belum Disetujui")
                      <input type="text" class="form-control" id="pdf_sp2d" name="pdf_sp2d" placeholder="Lampiran SP2D" disabled>
                      @elseif($d->validasi_ppspm == "Ditolak" || $d->validasi_ppspm == "Belum Disetujui")
                      <input type="text" class="form-control" id="pdf_sp2d" name="pdf_sp2d" placeholder="Lampiran SP2D" disabled>
                      @else
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="pdf_sp2d" name="pdf_sp2d" onchange="updateFileName('pdf_sp2d')" required>
                        <label class="custom-file-label" for="pdf_sp2d" id="pdf_sp2d_label">Upload SP2D</label>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="no_sp2d">Nomor SP2D</label>
                      @if($d->validasi_bendahara == "Ditolak" || $d->validasi_bendahara == "Belum Disetujui")
                      <input type="text" class="form-control" id="no_sp2d" name="no_sp2d" placeholder="Nomor SP2D" disabled>
                      @elseif($d->validasi_ppk == "Ditolak" || $d->validasi_ppk == "Belum Disetujui")
                      <input type="text" class="form-control" id="no_sp2d" name="no_sp2d" placeholder="Nomor SP2D" disabled>
                      @elseif($d->validasi_ppspm == "Ditolak" || $d->validasi_ppspm == "Belum Disetujui")
                      <input type="text" class="form-control" id="no_sp2d" name="no_sp2d" placeholder="Nomor SP2D" disabled>
                      @else
                      <input type="text" class="form-control" id="no_sp2d" name="no_sp2d" placeholder="Nomor SP2D" required>
                      @endif
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="tgl_validasi_sp2d">Tanggal SP2D</label>
                      @if($d->validasi_bendahara == "Ditolak" || $d->validasi_bendahara == "Belum Disetujui")
                      <input type="date" class="form-control" id="tgl_validasi_sp2d" name="tgl_validasi_sp2d" placeholder="Pilih Tanggal Validasi" disabled>
                      @elseif($d->validasi_ppk == "Ditolak" || $d->validasi_ppk == "Belum Disetujui")
                      <input type="date" class="form-control" id="tgl_validasi_sp2d" name="tgl_validasi_sp2d" placeholder="Pilih Tanggal Validasi" disabled>
                      @elseif($d->validasi_ppspm == "Ditolak" || $d->validasi_ppspm == "Belum Disetujui")
                      <input type="date" class="form-control" id="tgl_validasi_sp2d" name="tgl_validasi_sp2d" placeholder="Pilih Tanggal Validasi" disabled>
                      @else
                      <input type="date" class="form-control" id="tgl_validasi_sp2d" name="tgl_validasi_sp2d" placeholder="Pilih Tanggal Validasi" required>
                      @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 mb-3">
                      @if($d->pdf_pendukung && $d->pdf_spp && $d->pdf_ppspm && $d->pdf_sp2d)
                      <a href="{{ route('unduh-wabku', ['id'=> $d->id]) }}" target="_blank" class="btn btn-block btn-sm btn-success">Unduh PDF</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn-danger disabled">Unduh PDF</a>
                      @endif
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

                  @if($d->validasi_bendahara == "Ditolak" || $d->validasi_bendahara == "Belum Disetujui")
                  <button class="btn btn-success float-right mb-3" type="submit" disabled>Simpan</button>
                  @elseif($d->validasi_ppk == "Ditolak" || $d->validasi_ppk == "Belum Disetujui")
                  <button class="btn btn-success float-right mb-3" type="submit" disabled>Simpan</button>
                  @elseif($d->validasi_ppspm == "Ditolak" || $d->validasi_ppspm == "Belum Disetujui")
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