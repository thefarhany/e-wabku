@extends('master.master')

@section('title')
<title>Operator | Monitoring</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Monitoring</h1>
</div>

<div class="card-body background-light p-3">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th class="align-middle" scope="col">No</th>
          <th class="align-middle" scope="col">Subsaker</th>
          <th class="align-middle" scope="col">Uraian Wabku</th>
          <th class="align-middle" scope="col">Tanggal Pengajuan</th>
          <th class="align-middle" scope="col">Validasi PPK</th>
          <th class="align-middle" scope="col">Tanggal Validasi PPK</th>
          <th class="align-middle" scope="col">Lampiran PPK</th>
          <th class="align-middle" scope="col">Validasi PPSPM</th>
          <th class="align-middle" scope="col">Tanggal Validasi PPSPM</th>
          <th class="align-middle" scope="col">Lampiran SPM</th>
          <th class="align-middle" scope="col">SP2D</th>
          <th class="align-middle" scope="col">Tanggal SP2D</th>
          <th class="align-middle" scope="col">Lampiran SP2D</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $d->subsaker }}</td>
          <td class="align-middle">{{ $d->uraian_wabku }}</td>
          <td class="align-middle">{{ $d->created_at->format('d-m-Y') }}</td>
          <td class="align-middle">
            @if($d->validasi_ppk == "Disetujui")
            <span class="badge badge-success">Telah Disetujui</span>
            @elseif($d->validasi_ppk == "Ditolak")
            <span class="badge badge-danger">Ditolak</span>
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            @if($d->tgl_validasi_ppk)
            {{date('d-m-Y', strtotime($d->tgl_validasi_ppk))}}
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            @if($d->validasi_ppk == "Disetujui")
            <span class="badge bagde-info"><a href="{{ Storage::url($d->pdf_ppk) }}" target="_blank">PDF SPP</a></span>
            <span class="badge bagde-info"><a href="{{ Storage::url($d->pdf_ppk_pajak) }}" target="_blank">PDF SSP Pajak</a></span>
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            @if($d->validasi_ppspm == "Disetujui")
            <span class="badge badge-success">Telah Disetujui</span>
            @elseif($d->validasi_ppspm == "Ditolak")
            <span class="badge badge-danger">Ditolak</span>
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            @if($d->tgl_validasi_ppspm)
            {{date('d-m-Y', strtotime($d->tgl_validasi_ppspm))}}
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            @if($d->validasi_ppspm == "Disetujui")
            <span class="badge bagde-info"><a href="{{ Storage::url($d->pdf_ppspm) }}" target="_blank">PDF SPM</a></span>
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            @if($d->validasi_sp2d == "Disetujui")
            <span class="badge badge-success">Telah Disetujui</span>
            @elseif($d->validasi_sp2d == "Ditolak")
            <span class="badge badge-danger">Ditolak</span>
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            @if($d->tgl_validasi_sp2d)
            {{date('d-m-Y', strtotime($d->tgl_validasi_sp2d))}}
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
          <td class="align-middle">
            @if($d->validasi_sp2d == "Disetujui")
            <span class="badge bagde-info"><a href="{{ Storage::url($d->pdf_sp2d) }}" target="_blank">PDF SPM</a></span>
            @else
            <span class="badge badge-warning">Belum Disetujui</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection