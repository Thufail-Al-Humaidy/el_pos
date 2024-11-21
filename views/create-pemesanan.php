<?php

require_once __DIR__ . '/../Model/init.php';
if (!isset($_SESSION["full_name"])) {
  header("Location: login.php");
  exit;
}

$menus = new Item();
$menus = $menus->all();

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
  <link rel="stylesheet" href="../assets/modules/jquery-selectric/selectric.css">

  <!-- CSS Libraries -->

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
  <style>
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease-in-out;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .card .card-body {
      padding: 20px;
    }

    .card-title {
      font-size: 18px;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }

    .card-text {
      font-size: 14px;
      color: #777;
    }

    .card img {
      border-radius: 12px;
    }

    .card .badge {
      font-size: 12px;
      font-weight: 600;
      background-color: #ff7f50;
      top: 10px;
      left: 10px;
    }

    .card-footer {
      background-color: #f8f9fa;
      border-top: 1px solid #e1e1e1;
      padding: 12px;
      text-align: center;
    }

    .card-footer .btn {
      border-radius: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      font-size: 16px;
    }

    .card-footer .btn:hover {
      background-color: #0056b3;
    }

    .card img {
      border-radius: 12px;
      width: 100%;
      /* Menyesuaikan gambar agar memenuhi lebar card */
      height: 200px;
      /* Mengatur tinggi gambar agar konsisten */
      object-fit: cover;
      /* Memastikan gambar tetap terjaga proporsinya tanpa terdistorsi */
    }
  </style>
  <script>
    const itemsSelected = [{}];
    function addItem(idItem, quantity = 1) {
      itemsSelected.push({
        id: idItem,
        q: quantity,
      })
      alert(itemsSelected.map((item) => item.id));
    }
  </script>
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
            <h1>Tambah Pemesanan</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-6 d-md-flex align-items-center row">
                <?php foreach ($menus as $menu) : ?>
                  
                  <div onclick="addItem(<?= $menu['id_item'] ?>)" class="col-6 col-md-6 mb-2 px-1">
                    <div class="card position-relative">
                      <span class="position-absolute top-0 mt-1 ml-1 start-100 translate-middle badge rounded-pill bg-primary text-white">+1</span>
                      <img alt="image" src="../public/img/items/<?= $menu['attachment'] ?>" class="img-fluid rounded">
                      <div class="card-body p-1">
                        <h5 class="card-title mb-0"><?= $menu['name_item'] ?></h5>
                        <p class="card-text d-none d-md-block"><?= $menu['price'] ?></p>
                      </div>

                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              



              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Tambahkan Customer Baru</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Nama Customer</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Catatan</label>
                      <textarea name="text-area" id="" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control selectric">
                        <option>Paid</option>
                        <option>Debt</option>
                        <option>Cancel</option>
                      </select>
                    </div>
                    <div class="d-flex justify-content-end">
                      <button class="btn btn-primary">Tambahkan</button>
                    </div>
                  </div>
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
  <script src="../assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>
</body>

</html>