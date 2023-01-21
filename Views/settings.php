<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="Public/css/settings.css"/>
    <title>YourGameBook</title>
    <script src="https://kit.fontawesome.com/3ff5952e8a.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="base-container">
    <nav>
        <?php include('nav.php')?>
    </nav>
    <main>
        <?php
            setcookie('email', '', time() - 1);
        ?>
        <buttton class="logout">WYLOGUJ</buttton>
    </main>
</div>
</body>
</html>
<?php
