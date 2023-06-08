<?php
header("Location: /login");
?>
<?php

$users = new UserModel();

print_r($users->getAllUsers());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$data['title'];?></title>
</head>

<body>
    <h1><?=$data['title'];?></h1>
    <p><?=$data['content'];?></p>

    <?php foreach ($users->getAllUsers() as $key => $value) {
    echo "Firstname: " . $value['firstname'];
}

?>
</body>

</html>