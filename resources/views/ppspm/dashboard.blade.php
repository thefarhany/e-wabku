@extends('master.ppspm')

@section('title')
<title>PPSPM | Dashboard</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Filter -->
<form method="post" action="{{ route('filter-ppspm') }}">
  @csrf
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label for="subsaker">Subsaker</label>
      <select class="custom-select custom-select-sm" id="subsaker" name="subsaker">
        <option value="">Pilih Subsaker</option>
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
    <div class="col-md-3 mb-3">
      <label for="perintah_bayar">Perintah Bayar</label>
      <select class="custom-select custom-select-sm" id="perintah_bayar" name="perintah_bayar">
        <option value="">Pilih Perintah Bayar</option>
        <option value="Up">Up</option>
        <option value="Ls">Ls</option>
        <option value="Kontrak">Kontrak</option>
      </select>
    </div>
    <div class="col-md-3 mb-3">
      <label for="start_date">Tanggal Mulai Pengajuan</label>
      <input type="date" class="form-control form-control-sm" id="start_date" name="start_date">
    </div>
    <div class="col-md-3 mb-3">
      <label for="end_date">Tanggal Selesai Pengajuan</label>
      <input type="date" class="form-control form-control-sm" id="end_date" name="end_date">
    </div>
  </div>
  <button type="submit" class="btn btn-sm btn-primary">Filter</button>
</form>
<!-- End Filter -->

<div class="mt-4 background-light">
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
        @if($data->isEmpty())
        <tr>
          <td colspan="8" class="text-center">No Data to Show</td>
        </tr>
        @else
        @foreach($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $d->subsaker }}</td>
          <td class="align-middle">{{ $d->perintah_bayar }}</td>
          <td class="align-middle">{{ $d->uraian_wabku }}</td>
          <td class="align-middle">Rp {{ $d->jml_belanja }}</td>
          <td class="align-middle">{{ $d->created_at->format('d-m-Y') }}</td>
          <td class="align-middle">
            @if($d->validasi_ppspm == "Ditolak")
            <span class="badge badge-danger">Ditolak</span>
            @elseif($d->validasi_ppspm == "Disetujui")
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
                <form action="{{ route('validasi-ppspm', ['id' => $d->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-row">
                    <div class="form-group col-md-12 mb-3">
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
                      @if($d->pdf_pendukung)
                      <a href="{{ Storage::url($d->pdf_pendukung) }}" target="_blank" class="btn btn-block btn-sm btn-success">PDF Wabku</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn-danger disabled">PDF Wabku</a>
                      @endif
                    </div>
                    <div class="col-md-4 mb-3">
                      @if($d->pdf_spp)
                      <a href="{{ Storage::url($d->pdf_spp) }}" target="_blank" class="btn btn-block btn-sm btn-success">PDF SPP</a>
                      @else
                      <a href="#" class="btn btn-block btn-sm btn- disabled">PDF SPP</a>
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
                      <label for="status_validasi">Status Validasi</label>
                      @if(!$d->pdf_spp && !$d->pdf_ssp_pajak)
                      <input type="text" class="form-control" id="status_validasi" name="status_validasi" value="Menunggu Validasi PPK" disabled>
                      @elseif($d->validasi_ppspm == "Disetujui")
                      <input type="text" class="form-control" id="status_validasi" name="status_validasi" value="{{ $d->validasi_ppspm }}" disabled>
                      @else
                      <select class="custom-select" id="status_validasi" name="status_validasi">
                        <option default>Pilih Validasi</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                      </select>
                      @endif
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="tgl_validasi_ppspm">Tanggal Validasi</label>
                      @if(!$d->pdf_spp && !$d->pdf_ssp_pajak)
                      <input type="text" class="form-control" id="tgl_validasi_ppspm" name="tgl_validasi_ppspm" value="Menunggu Validasi PPK" disabled>
                      @elseif($d->validasi_ppspm == "Disetujui")
                      <input type="text" class="form-control" id="tgl_validasi_ppspm" name="tgl_validasi_ppspm" value="{{ $d->tgl_validasi_ppspm }}" disabled>
                      @else
                      <input type="date" class="form-control" id="tgl_validasi_ppspm" name="tgl_validasi_ppspm" placeholder="Pilih Tanggal Validasi" required>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    @if(!$d->pdf_spp && !$d->pdf_ssp_pajak)
                    <label for="ppspm_file_pdf">Upload PDF</label>
                    @elseif($d->validasi_ppspm == "Disetujui")
                    <label>Bukti PDF</label>
                    @else
                    <label for="ppspm_file_pdf">Upload PDF</label>
                    @endif
                    <div class="custom-file">
                      @if(!$d->pdf_spp && !$d->pdf_ssp_pajak)
                      <input type="text" class="form-control" value="Menunggu Validasi PPK" disabled>
                      @elseif($d->validasi_ppspm == "Disetujui")
                      <a href="{{ Storage::url($d->pdf_ppspm) }}" target="_blank" class="btn btn-block btn-sm btn-success"><i class="fa-solid fa-file-arrow-down"></i>&nbsp; Lihat SPM</a>
                      @else
                      <input type="file" class="custom-file-input" id="ppspm_file_pdf" name="ppspm_file_pdf" onchange="updateFileName('ppspm_file_pdf')">
                      <label class="custom-file-label" for="ppspm_file_pdf" id="ppspm_file_pdf_label">Upload SPM</label>
                      @endif
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                  <button class="btn btn-success float-right mb-3" type="submit">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Validasi Modal -->
        @endforeach
        @endif
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