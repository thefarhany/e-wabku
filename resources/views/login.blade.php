<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

  <title>E-Wabku</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- Sweet Alerts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

  <!-- Custom CSS -->
  <style>
    #page-top {
      /* background: url('/background.jpg') no-repeat center center fixed; */
      background: url('/background-1.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>

<body id="page-top" class="bg-primary">
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card border-0 shadow-lg my-5">
              <div class="card-body">
                <div class="row d-flex flex-column">
                  <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                      <img src="{{ asset('logo-2.png') }}" alt="Dharmagi" class="img-fluid" style="width: 90px; height: 90px;">
                      <img src="{{ asset('/favicon/android-chrome-512x512.png') }}" alt="Dharmagi" class="img-fluid" style="width: 90px; height: 90px;">
                      <img src="{{ asset('logo-1.png') }}" alt="Dharmagi" class="img-fluid" style="width: 100px; height: 100px;">
                    </div>
                    <h1 class="h3 m-4 font-weight-bold text-center">Selamat Datang <br> Di Aplikasi <span class="text-primary">E-Wabku</span></h1>
                  </div>
                  <div class="col-md-12">
                    <form class="user" method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukan Alamat Email" required>
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                      </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                      <hr>
                      <a href="{{ asset('/BUKU PANDUAN.pdf') }}" target="_blank" class="btn btn-danger btn-user btn-block">Panduan Wabku</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="fixed-bottom">
    <a class="btn btn-success float-right m-4" target="_blank" href="https://wa.me/6281328357558"><i class="fa-brands fa-whatsapp"></i>&nbsp; HAI Wabku</a>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
  <!-- Page level custom scripts -->
  <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Sweet Alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
  @if(session('success'))
  <script>
    swal({
      title: "Success!",
      text: "{{ session('success') }}",
      icon: "success",
      button: "OK",
    });
  </script>
  @endif
  @if(session('error'))
  <script>
    swal({
      title: "Error!",
      text: "{{ session('error') }}",
      icon: "error",
      button: "OK",
    });
  </script>
  @endif
  @yield('addons-script')
</body>

</html>