@extends('master.ppspm')

@section('title')
<title>PPSPM | Daftar Referensi</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Daftar Referensi</h1>
</div>

<div class="accordion" id="accordionExample">
  @foreach($dataRef as $ref)
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <a href="{{ Storage::url($ref->referensi_pdf) }}" target="_blank" class="btn text-primary btn-block text-left">
          <span class="font-weight-bold h4">{{ $ref->referensi }}</span>
        </a>
      </h2>
    </div>
  </div>
  @endforeach
</div>
@endsection