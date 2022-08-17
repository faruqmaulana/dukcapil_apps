<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <meta name="description" content=""> --}}
  {{-- <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors"> --}}
  {{-- <meta name="generator" content="Hugo 0.98.0"> --}}
  <title> {{ ucfirst(strtolower(auth()->user()->role)) }} Dashboard</title>

  {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/"> --}}


  {{-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="/css/dashboard.css" rel="stylesheet">
</head>

<body>

  @include('dashboard.layouts.header')

  <div class="container-fluid">
    <div class="row">
      @include('dashboard.layouts.sidebar')

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('container')
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="/js/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- confirm delete -->
  <script>
    $('.delete-data').click(function(event) {
      console.log(1)
      var form = $(this).closest("#deleteSubmit");
      event.preventDefault();
      Swal.fire({
        title: 'Apakah anda yakin ingin menghapus data ini?',
        text: "Data yang dihapus tidak dapat kembali.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DC3545',
        cancelButtonColor: '#198754',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      })
    })
  </script>

  @if(session()->has('success'))
  <script>
    $(
      Swal.fire({
        icon: 'success',
        title: 'Data berhasil ditambahkan!',
        text: '{{ Session::get("success") }}',
        showConfirmButton: false,
        timer: 2000
      }));
  </script>
  @endif

  @if(session()->has('update'))
  <script>
    $(
      Swal.fire({
        icon: 'success',
        title: 'Data berhasil diubah!',
        text: '{{ Session::get("update") }}',
        showConfirmButton: false,
        timer: 2000
      }));
  </script>
  @endif

  @if(session()->has('delete'))
  <script>
    $(
      Swal.fire({
        icon: 'success',
        title: 'Hapus data berhasil!',
        text: '{{ Session::get("delete") }}',
        showConfirmButton: false,
        timer: 2000
      }));
  </script>
  @endif

  @if(session()->has('finishTask'))
  <script>
    $(
      Swal.fire({
        icon: 'success',
        html: '<p style="font-size: 1.25rem; font-weight: 600;">Selamat, anda telah menyelesaikan tugas <strong>{{ Session::get("finishTask") }}</strong>!</p>',
        showConfirmButton: false,
        timer: 2000
      }));
  </script>
  @endif

</body>

</html>