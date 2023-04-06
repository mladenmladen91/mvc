<html>

<head></head>

<body>
    <form method="POST" action="/address/create">
        <input name="first_name" value="<?= (isset($requestParams["first_name"]) && count($errors) > 0) ? $requestParams["first_name"] : "" ?>" placeholder="Name" required maxlength="40" />
        <input name="last_name" value="<?= (isset($requestParams["last_name"]) && count($errors) > 0) ? $requestParams["last_name"] : "" ?>" placeholder="Surname" required maxlength="40" />
        <input name="street" value="<?= (isset($requestParams["street"]) && count($errors) > 0) ? $requestParams["street"] : "" ?>" placeholder="Street" required maxlength="40" />
        <input name="postal" value="<?= (isset($requestParams["postal"]) && count($errors) > 0) ? $requestParams["postal"] : "" ?>"  placeholder="Postal" required maxlength="40" />
        <input name="city" value="<?= (isset($requestParams["city"]) && count($errors) > 0) ? $requestParams["city"] : "" ?>" placeholder="City" required maxlength="40" />
        <input name="country" value="<?= (isset($requestParams["country"]) && count($errors) > 0) ? $requestParams["country"] : "" ?>"  style="<?php echo (isset($errors["country"])) ? "background:red" : "" ?>" placeholder="Country" required maxlength="40" />
        <button type="submit">Send</button>
    </form>
</body>

</html>