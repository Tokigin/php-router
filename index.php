<!DOCTYPE html>
<html lang="en">
<?php
require_once "./Cannel/Load.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cannel</title>
    <?php
    Page::LoadBootstrap();
    ?>
</head>

<body class="bg-dark text-white">
    <?php
    Page::Index();
    ?>
</body>

</html>