<?php
require_once __DIR__ . '/../Model/init.php';

if (!isset($_SESSION["full_name"])) {
  header("Location: login.php");
  exit;
}

$id_user = $_SESSION["$id_user"];

if (isset($_POST["submit"])) {
  if($_POST["new_pass"] !== $_POST["new_pass_confirm"]){
    echo "<script> alert('Password tidak sama'); window.location.href = 'edit-pass.php'</script>";
    
  }

  $result = $user->updatePassword($id_user, $_POST["old_pass"], $_POST["new_pass"]);
  if (gettype($result) == "string") {
    echo "<script> alert('{$result}'); window.location.href = 'edit-pass.php'</script>";
  } else {
    echo "<script> alert('Password berhasil diubah'); window.location.href = 'index.php'</script>";
  }
}
?>

<div class="row">
  <div class="col-12 col-md-6 col-lg-6">
    <div class="card">
      <img src="../assets/img/vector/change.jpg" alt="">
    </div>
  </div>
  <div class="col-12 col-md-6 col-lg-6">
    <div class="card">
      <div class="card-header">
        <h4>Edit Password</h4>
      </div>
      <div class="card-body">
        <input type="file" id="avatar" hidden>
        <div class="card profile-widget">
          <div class="profile-widget-header">
            <img alt="image" src="../assets/img/avatar/avatar-3.png" class="rounded-circle profile-widget-picture">
            <div class="profile-widget-items">
              <div class="profile-widget-item">
                <div class="profile-widget-item-label">Bergabung Sejak</div>
                <div class="profile-widget-item-value">1987</div>
              </div>
              <div class="profile-widget-item">
                <div class="profile-widget-item-label">Penjualan</div>
                <div class="profile-widget-item-value">$6,8K</div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="old_pass">Password Lama</label>
          <input type="password" name="old_pass" id="old_pass" class="form-control">
        </div>
        <div class="form-group">
          <label for="new_pass">Password Baru</label>
          <input type="password" name="new_pass" id="new_pass" class="form-control">
        </div>
        <div class="form-group">
          <label for="new_pass_confirm">Password Baru</label>
          <input type="password" id="new_pass_confirm" name="new_pass_confirm" class="form-control">
        </div>
        <div class="d-flex justify-content-end">
          <button class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>