<html>

<head></head>

<body>
    <ul>
        <?php
        if (isset($data)) {
            foreach ($data->products as $product) { ?>
                <li><?= $product["last_name"] ?></li>
            <?php } 
            
            ?>
        <?php } ?>
    </ul>
</body>

</html>