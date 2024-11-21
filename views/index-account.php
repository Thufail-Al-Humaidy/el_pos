<?php

require_once __DIR__ . '/../Model/init.php';
if (!isset($_SESSION["full_name"])) {
  header("Location: login.php");
  exit;
}

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
            <h1>Blank Page</h1>
          </div>
          <div class="d-flex mb-3">
            <button class="btn btn-primary mr-3 klikMenu" data-id="info">Info Akun</button>
            <button class="btn btn-secondary klikMenu" data-id="edit">Edit Akun</button>
            <button class="btn btn-warning ml-3 klikMenu" data-id="edit_pass">Ganti Password</button>
          </div>
          <div class="section-body">

            <div id="isi_load"></div>

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

  <script type="text/javascript">
    $(document).ready(function() {
      $('.klikMenu').click(function() {
        var menu = $(this).data('id');
        if (menu == "info") {
          $('#isi_load').load('../component/info_ac.php');
        } else if (menu == "edit") {
          $('#isi_load').load('../component/edit.php');
        } else if (menu == "edit_pass") {
          $('#isi_load').load('../component/edit_pass.php');
        }
      });

      $('#isi_load').load('../component/info_ac.php');
    });
  </script>
</body>

</html>