@extends('master.master')

@section('title')
<title>Operator | Rekam Pengajuan Wabku</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Rekam Pengajuan Wabku</h1>
  <a href="{{ route('tambah-wabku') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fa-solid fa-plus"></i>
    &nbsp;Pengajuan Wabku</a>
</div>

<div class="card-body background-light p-3">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th class="align-middle">No</th>
          <th class="align-middle">Subsaker</th>
          <th class="align-middle">Jenis Perintah Bayar</th>
          <th class="align-middle">Uraian Wabku</th>
          <th class="align-middle">Tanggal Pengajuan</th>
          <th class="align-middle">Jumlah Belanja</th>
          <th class="align-middle">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @if($data->isEmpty())
        <tr>
          <td colspan="7" class="text-center">No Data to Show</td>
        </tr>
        @else
        @foreach($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $d->subsaker }}</td>
          <td class="align-middle">{{ $d->perintah_bayar }}</td>
          <td class="align-middle">{{ $d->uraian_wabku }}</td>
          <td class="align-middle">{{ $d->created_at->format('d-m-Y') }}</td>
          <td class="align-middle">Rp {{ $d->jml_belanja }}</td>
          <td class="align-middle">
            <a href="{{ route('detail-wabku', ['id' => $d->uraian_wabku]) }}" data-toggle="modal" data-target="#detail-wabku-{{ $d->id }}" class="mr-2"><i class="fa-solid fa-eye"></i></a>
            <a href="#" data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"><i class="fa-solid fa-trash-can"></i></a>
          </td>
        </tr>

        <!-- Detail Modal -->
        <div class="modal fade" id="detail-wabku-{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $d->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-{{ $d->id }}">{{ $d->program }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="#">
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
                    <div class="col-md-12 mb-3">
                      <label for="created_at">Tanggal Pengajuan</label>
                      <input type="text" class="form-control" id="created_at" name="created_at" value="{{ date('d-m-Y', strtotime($d->created_at)) }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="program">Program</label>
                      <input type="text" class="form-control" id="program" name="program" value="{{ $d->program }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="npwp">NPWP</label>
                      <input type="text" class="form-control" id="npwp" name="npwp" value="{{ $d->npwp }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label for="uraian_wabku">Uraian Wabku</label>
                      <input type="text" class="form-control" id="uraian_wabku" name="uraian_wabku" value="{{ $d->uraian_wabku }}" disabled>
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
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <label for="jml_belanja">Jumlah Belanja</label>
                      <input type="text" class="form-control" id="jml_belanja" name="jml_belanja" value="Rp {{ $d->jml_belanja }}" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="file_pdf">Lampiran Wabku</label>
                    <div>
                      <a href="{{ Storage::url($d->pdf_pendukung) }}" target="_blank" class="btn btn-success btn-block"><i class="fa-solid fa-file-arrow-down"></i>&nbsp; Lihat PDF</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Batal</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Detail Modal -->

        <!-- Modal Delete -->
        <div class="modal fade" id="modal-hapus{{ $d->id }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Hapus Wabku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah Anda Yakin Akan Hapus <b>{{ $d->program }}</b> ?</p>
              </div>
              <div class="modal-footer">
                <form action="{{ route('hapus-wabku', ['id' => $d->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal Delete -->
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection