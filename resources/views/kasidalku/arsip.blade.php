@extends('master.kasidalku')

@section('title')
<title>Kasidalku | Arsip</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Arsip</h1>
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
          <th class="align-middle" scope="col">Download PDF</th>
        </tr>
      </thead>
      <tbody>
        @if($data->isEmpty())
        <tr>
          <td colspan="5" class="text-center">No Archive</td>
        </tr>
        @else
        @foreach($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $d->subsaker }}</td>
          <td class="align-middle">{{ $d->uraian_wabku }}</td>
          <td class="align-middle">{{ $d->created_at->format('d-m-Y') }}</td>
          <td class="align-middle">
            @if($d->pdf_arsip)
            <a href="{{ Storage::url($d->pdf_arsip) }}" target="_blank" class="btn btn-sm btn-success">Download Arsip</a>
            @else
            <span class="text-muted">No Archive</span>
            @endif
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection