@extends('master.kasidalku')

@section('title')
<title>Kasidalku | Dashboard</title>
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
          <td class="align-middle">{{ $d->created_at->format('d-m-Y') }}</td>
          <td class="align-middle">
            <a href="{{ route('detail-wabku', ['id' => $d->id]) }}" data-toggle="modal" data-target="#detail-modal-{{ $d->id }}"><i class="fa-solid fa-eye"></i></a>
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
                <form>
                  @csrf
                  @method('PUT')
                  <div class="form-row">
                    <div class="form-group col-md-12 mb-3">
                      <label for="subsaker">Subsaker</label>
                      <input type="text" class="form-control" id="subsaker" name="subsaker" value="{{ $d->subsaker }}" disabled>
                    </div>
                  </div>
                  <div class=" form-row">
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
                  <h5 class="font-weight-bold">Lampiran PDF</h5>
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      @if($d->pdf_pendukung )
                      <a href="{{ Storage::url($d->pdf_pendukung) }}" target="_blank" class="btn btn-block btn-sm btn-success">PDF Wabku</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn-danger disabled">PDF Wabku</a>
                      @endif
                    </div>
                    <div class="col-md-4 mb-3">
                      @if($d->pdf_spp)
                      <a href="{{ Storage::url($d->pdf_spp) }}" target="_blank" class="btn btn-block btn-sm btn-success">PDF SPP</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn-danger disabled">PDF SPP</a>
                      @endif
                    </div>
                    <div class="col-md-4 mb-3">
                      @if($d->pdf_ssp_pajak)
                      <a href="{{ Storage::url($d->pdf_ssp_pajak) }}" target="_blank" class="btn btn-block btn-sm btn-success">PDF SSP Pajak</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn-warning disabled">PDF SSP Pajak</a>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      @if($d->pdf_ppspm)
                      <a href="{{ Storage::url($d->pdf_ppspm) }}" target="_blank" class="btn btn-block btn-sm btn-success">PDF SPM</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn-danger disabled">PDF SPM</a>
                      @endif
                    </div>
                    <div class="col-md-6 mb-3">
                      @if($d->pdf_sp2d)
                      <a href="{{ Storage::url($d->pdf_sp2d) }}" target="_blank" class="btn btn-block btn-sm btn-success">PDF SP2D</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn-danger disabled">PDF SP2D</a>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-12 mb-3">
                      @if($d->pdf_pendukung && $d->pdf_spp && $d->pdf_ppspm && $d->pdf_sp2d)
                      <a href="{{ route('unduh-pdf', ['id'=> $d->id]) }}" target="_blank" class="btn btn-block btn-sm btn-success">Unduh PDF</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn-danger disabled">Unduh PDF</a>
                      @endif
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Batal</button>
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