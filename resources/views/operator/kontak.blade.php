@extends('master.master')

@section('title')
<title>Operator | Kontak PIC</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Kontak PIC</h1>
</div>

<div class="row">
  <div class="col-4 text-center">
    <img src="{{ asset('profile.jpg') }}" height="300px" width="350px" alt="Letda Cku Manirun" class="img-fluid rounded mx-auto">
  </div>
  <div class="col-8">
    <h2 class="font-weight-bold">Letda Cku Manirun</h2>
    <h5>Jabatan: Paku Bekangdam NA.02.0609</h5>
    <div class="mt-4">
      <h4 class="font-weight-bold">
        Whatsapp
      </h4>
      <a class="font-weight-bold" href="https://wa.me/081328357558">081328357558</a>
      <h4 class="font-weight-bold mt-3">
        Email
      </h4>
      <a class="font-weight-bold" href="mailto:jayantaka88@gmail.com">jayantaka88@gmail.com</a>
    </div>
  </div>
</div>
@endsection