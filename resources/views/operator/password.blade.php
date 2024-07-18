@extends('master.master')

@section('title')
<title>Operator | Ganti Password</title>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ganti Password</h1>
</div>

<form action="{{ route('ganti-password-operator') }}" method="POST">
  @csrf
  <label for="password">Password</label>
  <div class="input-group mb-3">
    <input type="password" class="form-control" id="password" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Password" required>
    <div class="input-group-prepend">
      <span class="input-group-text" id="toggle-password">
        <i class="fa-solid fa-eye" id="toggle-icon"></i>
      </span>
    </div>
  </div>

  <label for="password">Password</label>
  <div class="input-group mb-3">
    <input type="password" class="form-control" id="retype-password" name="password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Ketik Ulang Password" required>
    <div class="input-group-prepend">
      <span class="input-group-text" id="toggle-retype-password">
        <i class="fa-solid fa-eye" id="toggle-retype-icon"></i>
      </span>
    </div>
  </div>
  <button class="btn btn-primary float-right mb-3" type="submit">Simpan</button>
</form>
@endsection

@section('addons-script')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('toggle-password');
    const toggleIcon = document.getElementById('toggle-icon');

    const retypePasswordInput = document.getElementById('retype-password');
    const retypeTogglePassword = document.getElementById('toggle-retype-password');
    const retypeToggleIcon = document.getElementById('toggle-retype-icon');

    togglePassword.addEventListener('click', function() {
      // Toggle the type attribute
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      // Toggle the icon
      toggleIcon.classList.toggle('fa-eye');
      toggleIcon.classList.toggle('fa-eye-slash');
    });

    retypeTogglePassword.addEventListener('click', function() {
      // Toggle the type attribute
      const type = retypePasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      retypePasswordInput.setAttribute('type', type);

      // Toggle the icon
      retypeToggleIcon.classList.toggle('fa-eye');
      retypeToggleIcon.classList.toggle('fa-eye-slash');
    });
  });
</script>
@endsection