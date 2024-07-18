<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>403 Forbidden</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      color: #333;
      text-align: center;
      padding: 50px;
    }

    .container {
      max-width: 600px;
      margin: auto;
    }

    h1 {
      font-size: 48px;
      margin-bottom: 20px;
    }

    p {
      font-size: 18px;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>403 Forbidden</h1>
    <p>Anda tidak memiliki akses ke halaman ini.</p>
    <p><a href="{{ URL::previous() }}">Kembali ke Halaman Sebelumnya</a></p>
  </div>
</body>

</html>