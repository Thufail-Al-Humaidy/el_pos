<?php
require_once __DIR__ . '/../Model/init.php';
require_once __DIR__ . '/../Model/Category.php';

$key = $_GET['keyword'];
$kategori = new Category();
//$categories = $kategori->search($key);
$categories = "";

$limit = 3; // Data per page
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // Halaman yang aktif
$key = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$offset = ($pageActive - 1) * $limit;
$length = $key != '' ? count($kategori->search($key)) : count($kategori->all());
$countPage = ceil($length / $limit);


$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;

$categories = $key != '' ? $kategori->search($key, $offset, $limit) : $kategori->paginate($offset, $limit);

?>
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
                    <td> <?= htmlspecialchars($category['name_category']) ?></td>
                    <td>
                        <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        <a href="#" class="btn btn-success"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                <?php $i++ ?>
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