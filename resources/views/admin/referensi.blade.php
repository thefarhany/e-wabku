@extends('master.admin')

@section('title')
<title>Admin | Daftar Referensi</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Daftar Referensi</h1>
  <a href="{{ route('add-referensi') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fa-solid fa-plus"></i>
    &nbsp;Tambah Referensi
  </a>
</div>

<div class="background-light mt-5">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th class="align-middle" width="5%">No</th>
          <th class="align-middle">Referensi</th>
          <th class="align-middle" width="15%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $d->referensi }}</td>
          <td class="align-middle">
            <a href="{{ Storage::url($d->referensi_pdf) }}" target="_blank" class="mr-2"><i class="fa-solid fa-eye"></i></a>
            <a href="#" data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"><i class="fa-solid fa-trash-can"></i></a>
          </td>
        </tr>

        <!-- Modal Delete -->
        <div class="modal fade" id="modal-hapus{{ $d->id }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Hapus Referensi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah Anda Yakin Akan Hapus <b>{{ $d->referensi }}</b> ?</p>
              </div>
              <div class="modal-footer">
                <form action="{{ route('hapus-referensi', ['id' => $d->id]) }}" method="POST">
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
      </tbody>
    </table>
  </div>
</div>
@endsection