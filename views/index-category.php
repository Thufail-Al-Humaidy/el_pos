<?php
require_once __DIR__ . '/../DB/Connections.php';
require_once __DIR__ . '/../Model/init.php';

if (!isset($_SESSION["full_name"])) {
  header("Location: login.php");
  exit;
}

$kategori = new Category();
$limit = 3;
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$length = count($kategori->all());
$countPage = ceil($length / $limit);

$key = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$offset = ($pageActive - 1) * $limit;
$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;
$categories = $kategori->paginate($offset, $limit);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Category Home &mdash; Stisla</title>

  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- <style>
    .modal-content {
      width: 80%;
      max-width: 600px;
    }

    .modal-body {
      padding: 20px;
    }
  </style> -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php include "../component/navbar.php"; ?>
      <?php include "../component/sidebar.php"; ?>

      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Home Kategori</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Advanced Table</h4>
                    <div class="card-header-form">
                      <form method="GET" action="">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search" id="keyword" name="keyword" value="<?= htmlspecialchars($key) ?>">
                          <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div id="bungkus" class="table-responsive">
                      <?php if (empty($categories)) : ?>
                        <div class="d-flex justify-content-center m-5">
                          <div class="pesan">
                            <img src="../assets/img/icon/no-data.gif" alt="" width="100">
                            <p>Tidak Ada Data</p>
                          </div>
                        </div>
                      <?php else : ?>
                        <table class="table table-striped">
                          <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                          </tr>
                          <?php $i = 1; ?>
                          <?php foreach ($categories as $category) : ?>
                            <tr>
                              <td><?= $i ?></td>
                              <td><?= htmlspecialchars($category['name_category']) ?></td>
                              <td>
                                <button onclick="modaldetail(<?= $category['id_category'] ?>, '<?= htmlspecialchars($category['name_category']) ?>')" class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                <a href="../services/delete-category.php?id=<?= $category['id_category'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                <a href="edit-category.php?id=<?= $category['id_category'] ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                              </td>
                            </tr>
                            <?php $i++; ?>
                          <?php endforeach; ?>
                        </table>
                        <div class="card-body d-flex justify-content-center">
                          <nav aria-label="Page navigation">
                            <ul class="pagination">
                              <li class="page-item <?= $pageActive == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $prev ?>&keyword=<?= $key ?>">Previous</a>
                              </li>
                              <?php for ($i = 1; $i <= $countPage; $i++) : ?>
                                <li class="page-item <?= $pageActive == $i ? 'active' : '' ?>">
                                  <a class="page-link" href="?page=<?= $i ?>&keyword=<?= $key ?>"><?= $i ?></a>
                                </li>
                              <?php endfor; ?>
                              <li class="page-item <?= $pageActive == $countPage ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $next ?>&keyword=<?= $key ?>">Next</a>
                              </li>
                            </ul>
                          </nav>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include('../component/footer.php'); ?>
    </div>
  </div>

  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/modules/jquery.min.js"></script>
  <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script>
    $("#keyword").on("keyup", () => {
      $("#bungkus").load("../search/search-category.php?keyword=" + $("#keyword").val());
    });

    function modaldetail(id, name) {
      const content = `<ul><li><strong>Id Kategori:</strong> ${id}</li><li><strong>Nama Kategori:</strong> ${name}</li></ul>`;
      $('#detailModal .modal-body').html(content);
      $('#detailModal').modal('show');
    }
  </script>
</body>

</html>