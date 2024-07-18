@extends('master.admin')

@section('title')
<title>Admin | Dashboard</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
</div>

<div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Wabku</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalWabku }}</div>
          </div>
          <div class="col-auto">
            <i class="fa-solid fa-file fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Wabku Diproses</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $wabkuProses }}</div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fa-solid fa-file-signature fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Wabku Disetujui</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $wabkuDisetujui }}</div>
          </div>
          <div class="col-auto">
            <i class="fa-solid fa-file-circle-check fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah User</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser }}</div>
          </div>
          <div class="col-auto">
            <i class="fa-solid fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection