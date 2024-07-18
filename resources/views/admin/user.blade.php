@extends('master.admin')

@section('title')
<title>Admin | Daftar User</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Daftar User</h1>
  <a href="{{ route('add-user') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fa-solid fa-plus"></i>
    &nbsp;Tambah User
  </a>
</div>

<div class="background-light mt-5">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th class="align-middle">No</th>
          <th class="align-middle">Nama Lengkap</th>
          <th class="align-middle">NIP/NRP</th>
          <th class="align-middle">Jabatan</th>
          <th class="align-middle">Sub Satker</th>
          <th class="align-middle">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $d)
        <tr class="text-center">
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $d->nama_lengkap }}</td>
          <td class="align-middle">{{ $d->nip_nrp }}</td>
          <td class="align-middle">{{ $d->jabatan }}</td>
          <td class="align-middle">{{ $d->subsaker }}</td>
          <td class="align-middle">
            <a href="{{ route('detail-user', ['nama_lengkap' => $d->nama_lengkap]) }}" data-toggle="modal" data-target="#detail-user-{{ $d->id }}" class="mr-2"><i class="fa-solid fa-eye"></i></a>
            <a href="{{ route('edit-user', ['id' => $d->id]) }}"><i class="fa-solid fa-user-pen"></i></a>
            <a href="#" data-toggle="modal" data-target="#modal-hapus{{ $d->id }}"><i class="fa-solid fa-trash-can"></i></a>
          </td>
        </tr>

        <!-- Validasi Modal -->
        <div class="modal fade" id="detail-user-{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $d->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-{{ $d->id }}">{{ $d->nama_lengkap }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="">
                  <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                      <label for="nip_nrp">NIP/NRP</label>
                      <input type="text" class="form-control" id="nip_nrp" name="nip_nrp" value="{{ $d->nip_nrp }}" disabled>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                      <label for="nama_lengkap">Nama Lengkap</label>
                      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ $d->nama_lengkap }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="no_ktp">Nomor KTP</label>
                      <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ $d->no_ktp }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="tgl_lahir">Tanggal Lahir</label>
                      <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ date('d-m-Y', strtotime($d->tgl_lahir)) }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="jenis_kelamin">Jenis Kelamin</label>
                      <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ $d->jenis_kelamin }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $d->alamat }}" disabled>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="jabatan">Jabatan</label>
                      <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $d->jabatan }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="subsaker">Subsaker</label>
                      <input type="text" class="form-control" id="subsaker" name="subsaker" value="{{ $d->subsaker }}" disabled>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Batal</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Validasi Modal -->

        <!-- Modal Delete -->
        <div class="modal fade" id="modal-hapus{{ $d->id }}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Hapus User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah Anda Yakin Akan Hapus <b>{{ $d->nama_lengkap }}</b> ?</p>
              </div>
              <div class="modal-footer">
                <form action="{{ route('hapus-user', ['id' => $d->id]) }}" method="POST">
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