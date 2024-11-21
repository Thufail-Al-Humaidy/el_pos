<?php
require_once __DIR__ . '/../Model/init.php';
require_once __DIR__ . '/../Model/Item.php';

$key = $_GET['keyword'];
$menu = new Item();
//$categories = $kategori->search($key);
$menus = "";

$limit = 3; // Data per page
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // Halaman yang aktif
$key = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$offset = ($pageActive - 1) * $limit;
$length = $key != '' ? count($menu->search($key, $offset, $limit)) : count($menu->all());
$countPage = ceil($length / $limit);


$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;

$menus = $key != '' ? $menu->search($key, $offset, $limit) : $menu->paginate($offset, $limit);

?>
<div class="table-responsive">
    <?php if (empty($menus)) : ?>
        <div class="d-flex justify-content-center m-5">
            <div class="pesan">
                <img src="../assets/img/icon/no-data.gif" alt="" width="100">
                <p>Tidak Ada Data</p>
            </div>
        </div>
    <?php else: ?>
        <table class="table table-striped">
            <tr>
                <th>
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                </th>
                <th>Name</th>
                <th>Attachment</th>
                <th>Price</th>
                <th>Category</th>
                <th>Due Date</th>
                <th>Action</th>
            </tr>
            <?php foreach ($menus as $m) : ?>
                <tr>
                    <td class="">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>
                    <td><?= $m["name"] ?></td>
                    <td><img src="../public/img/items/<?= $m["attachment"] ?>" alt="" width="50"></td>
                    <td><?= $m["price"] ?></td>
                    <td><?= $m["category_id"] ?></td>
                    <td> <?= $m["created_at"] ?></td>
                    <td>
                        <a href="#" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        <a href="#" class="btn btn-success"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
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