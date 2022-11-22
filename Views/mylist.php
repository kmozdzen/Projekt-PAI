<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="Public/css/mylist.css"/>
        <title>YourGameBook</title>
        <script src="https://kit.fontawesome.com/3ff5952e8a.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="base-container">
            <nav>
                <div class="hider">
                    
                </div>
                <div class="strap">
                    <div class="list-icon">
                        <i class="fa-solid fa-list"></i>
                    </div>
                    <img src="Public/img/logo.svg">
                    <ul>
                        <li>
                            <a href="search" class="button">Add game</a>
                        </li>
                        <li>
                            <a href="mylist" class="button">My list</a>
                        </li>
                        <li>
                            <a href="statistics" class="button">Statistics</a>
                        </li>
                        <li>
                            <a href="users" class="button">Users</a>
                        </li>
                        <li>
                            <a href="#" class="setting-button"><i class="fa-solid fa-gear"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main>
                <div class="my_list">
                    <p>My list</p>
                </div>
                <div class="list">
                    <ul>
                        <?php foreach ($my_list as $game): ?>
                            <li>
                                <div class="l_position">
                                    <div class="number">
                                        <p>1</p>
                                    </div>
                                    <div class="block">
                                        <img src="Public/img/game.webp">
                                        <p class="game-name">The Witcher: Wild Hunt</p>
                                        <p class="rate"><?=$game->getRating();?></p>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </main>
        </div>
    </body>
</html>