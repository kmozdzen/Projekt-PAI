<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="Public/css/settings.css"/>
    <title>YourGameBook</title>
    <script src="https://kit.fontawesome.com/3ff5952e8a.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/scripts2.js" defer></script>
</head>
<body>
<div class="base-container">
    <nav>
        <?php include('nav.php')?>
    </nav>
    <main>
        <div class="user-panel">
            <p class="user-email">email:<span> <?php echo $user->getEmail() ?></span></p>
            <p class="user-name">name: <span><?php echo $user->getName() ?></span></p>
            <p class="user-surname">surname: <span><?php echo $user->getSurname() ?></span></p>
            <p class="user-phone">phone: <span><?php echo $user->getPhone() ?></span></p>
        </div>
        <div class="user-change">
            <form class="change-data" action="changeData" method="POST">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="new-email" type="text" placeholder="new email@email.com">
                <input name="new-password" type="password" placeholder="new password">
                <input name="new-confirmedPassword" type="password" placeholder="confirm new password">
                <input name="new-name" type="text" placeholder="new name">
                <input name="new-surname" type="text" placeholder="new surname">
                <input name="new-phone" type="text" placeholder="new phone">
                <button type="submit" class="ok">OK</button>
            </form>
        </div>
        <div class="logout-container">
            <form action="logout" method="post">
                <button class="logout">Log out</button>
            </form>
        </div>
    </main>
</div>
<?php include('nav-phone.php') ?>
</body>
</html>
<?php
