<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="Public/css/users.css"/>
        <title>YourGameBook</title>
        <script src="https://kit.fontawesome.com/3ff5952e8a.js" crossorigin="anonymous"></script>
        <script src="Public/js/addUser.js" type="text/javascript" defer></script>
        <script src="Public/js/statistics.js" type="text/javascript" defer></script>
        <script src="Public/js/fieldUser.js" type="text/javascript" defer></script>
    </head>
    <body>
        <div class="base-container">
            <nav>
                <?php include('nav.php')?>
            </nav>
            <main>
                <header>
                        <div class="user-container">
                            <div class="typing-place">
                                <input name="show-user" type="text" placeholder="Search for users" list="scripts">
                                <datalist id="scripts">
                                    <?php foreach ($users as $user): ?>
                                        <option><?= $user->getEmail(); ?></option>
                                    <?php endforeach; ?>
                                </datalist>
                            </div>
                            <div class="icons">
                                <i class="fa-solid fa-xmark"></i>
                                <hr/>
                                <i id="user-serach-button" class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                </header>
                <section>
                    <div class="user">
                        <input id="user-name" name="user-name" readonly="readonly" value=<?php echo $name ?>>
                        <i class="fa-solid fa-heart"></i>
                        <p id="likes"></p>
                    </div>
                    <div class="best-games">
                        <h2>Best games</h2>
                        <div class="game-list">
                        </div>
                    </div>
                </section>
            </main>
        </div>
        <?php include('nav-phone.php') ?>
    </body>
</html>

<template id="games-element-template">
    <div class="game-list">
        <div class="l_position">
            <div class="number">
                <p class="number-p"></p>
            </div>
            <div class="block">
                <img src="">
                <p class="game-name">game name</p>
                <p class="rate">rate</p>
            </div>
        </div>
    </div>
</template>