<?php
require_once __DIR__ . '/../Model/init.php';

if (!isset($_SESSION["full_name"])) {
  header("Location: login.php");
  exit;
}

$categories = new Category;

if (isset($_POST["submit"])) {
  $categoryName = $_POST["name_category"];
  if (strlen($categoryName) > 225) {
    header("Location: create-category.php?status=error");
    exit;
  }

  $category = [
    "name_category" => $categoryName
  ];

  if ($categories->create($category)) {
    header("Location: create-category.php?status=success");
  } else {
    header("Location: create-category.php?status=error");
  }
}
?>



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blank Page &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <!-- Navbar -->
      <?php include('../component/navbar.php') ?>
      <!-- SideBar -->
      <?php include('../component/sidebar.php') ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Tambah Kategori</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <img src="../assets/img/vector/Fastfood.png" alt="">
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Input Text</h4>
                  </div>
                  <form action="" method="post" class="card-body">
                    <div class="form-group">
                      <label for="name_category">Masukan Kategori Baru</label>
                      <input type="text" id="name_category" name="name_category" class="form-control">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button class="btn btn-primary" type="submit" name="submit">Tambahkan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- Footer -->
      <?php include('../component/footer.php') ?>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="../assets/modules/jquery.min.js"></script>
  <script src="../assets/modules/popper.js"></script>
  <script src="../assets/modules/tooltip.js"></script>
  <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../assets/modules/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
  <?php
  if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
      echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil ditambahkan!',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    } elseif ($_GET['status'] == 'error') {
      echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menambahkan data.',
                showConfirmButton: true
            });
        </script>";
    }
  }
  ?>
</body>

</html>