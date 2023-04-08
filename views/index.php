<?php include('includes/header.php') ?>
<div class="container">
    <div class="col-12 mx-auto text-center">
        <h1>Address app</h1>
    </div>
    <div class="col-12 text-center mt-2">
        <table class="table">
            <thead>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Street</th>
                <th scope="col">Postal</th>
                <th scope="col">City</th>
                <th scope="col">Germany</h>
            </thead>
            <tbody>
                <?php
                if (isset($data)) {
                    foreach ($data->products as $product) { ?>
                        <tr>
                            <td><?= $product["first_name"] ?></td>
                            <td><?= $product["last_name"] ?></td>
                            <td><?= $product["street"] ?></td>
                            <td><?= $product["postal"] ?></td>
                            <td><?= $product["city"] ?></td>
                            <td><?= $product["country"] ?></td>
                        </tr>
                    <?php }

                    ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-12 text-center">
        <nav aria-label="Page navigation example text-center">
            <ul class="pagination">
                <?php if (!is_null($data->previous)) { ?>
                    <li class="page-item"><a class="page-link" href="/address/?page=<?= $data->previous ?>"><?= $data->previous ?></a></li>
                <?php
                }
                ?>
                <li class="page-item"><a class="page-link active" href="#"><?= $data->page ?></a></li>
                <?php if (!is_null($data->next)) { ?>
                <li class="page-item"><a class="page-link" href="/address/?page=<?= $data->next ?>"><?= $data->next ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <?php include('includes/footer.php') ?>