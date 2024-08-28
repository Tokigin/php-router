<!DOCTYPE html>
<html lang="en">
<?php require_once "./Cannel/Load.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Page::$Head ?></title>
    <?php Page::LoadBootstrap(Page::$Bootstrap); ?>
</head>

<body>
    <?php
    Page::Index();
    ?>
</body>

</html>