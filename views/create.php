<?php include('includes/header.php') ?>
<div class="col-12 text-center mb-4"><h1>Create address</h1></div>
<div class="col-6 mx-auto">
<form method="POST" action="/address/create">
    <div class="form-group">
        <input class="form-control" name="first_name" value="<?= (isset($requestParams["first_name"]) && count($errors) > 0) ? $requestParams["first_name"] : "" ?>" style="<?php echo (isset($errors["first_name"])) ? "background:red" : "" ?>" placeholder="Name" required maxlength="40" />
        <?php if (isset($errors["first_name"])) { ?> <span style="color:red">* <?= $errors["first_name"] ?></span> <?php } ?>
    </div>
    <div class="form-group">
        <input class="form-control" name="last_name" value="<?= (isset($requestParams["last_name"]) && count($errors) > 0) ? $requestParams["last_name"] : "" ?>" style="<?php echo (isset($errors["last_name"])) ? "background:red" : "" ?>" placeholder="Surname" required maxlength="40" />
        <?php if (isset($errors["last_name"])) { ?> <span style="color:red">* <?= $errors["last_name"] ?></span> <?php } ?>
    </div>
    <div class="form-group">
        <input class="form-control" name="street" value="<?= (isset($requestParams["street"]) && count($errors) > 0) ? $requestParams["street"] : "" ?>" style="<?php echo (isset($errors["street"])) ? "background:red" : "" ?>" placeholder="Street" required maxlength="40" />
        <?php if (isset($errors["street"])) { ?> <span style="color:red">* <?= $errors["street"] ?></span> <?php } ?>
    </div>
    <div class="form-group">
        <input class="form-control" name="postal" value="<?= (isset($requestParams["postal"]) && count($errors) > 0) ? $requestParams["postal"] : "" ?>" style="<?php echo (isset($errors["postal"])) ? "background:red" : "" ?>" placeholder="Postal" required maxlength="40" />
        <?php if (isset($errors["postal"])) { ?> <span style="color:red">* <?= $errors["postal"] ?></span> <?php } ?>
    </div>
    <div class="form-group">
        <input class="form-control" name="city" value="<?= (isset($requestParams["city"]) && count($errors) > 0) ? $requestParams["city"] : "" ?>" style="<?php echo (isset($errors["city"])) ? "background:red" : "" ?>" placeholder="City" required maxlength="40" />
        <?php if (isset($errors["city"])) { ?> <span style="color:red">* <?= $errors["city"] ?></span> <?php } ?>
    </div>
    <div class="form-group">
        <input class="form-control" name="country" value="<?= (isset($requestParams["country"]) && count($errors) > 0) ? $requestParams["country"] : "" ?>" style="<?php echo (isset($errors["country"])) ? "background:red" : "" ?>" placeholder="Country" required maxlength="40" />
        <?php if (isset($errors["country"])) { ?> <span style="color:red">* <?= $errors["country"] ?></span> <?php } ?>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Send</button>
    </div>
</form>
</div>
<?php include('includes/footer.php') ?>