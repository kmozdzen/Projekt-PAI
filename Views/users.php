<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="Public/css/users.css"/>
        <title>YourGameBook</title>
        <script src="https://kit.fontawesome.com/3ff5952e8a.js" crossorigin="anonymous"></script>
         <script src="Public/js/addUser.js" type="text/javascript" defer></script>

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
                            <a href="settings" class="setting-button"><i class="fa-solid fa-gear"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main>
                <form action="getUserStats" method="POST" ENCTYPE="multipart/form-data">
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
                                    <button><i class="fa-solid fa-xmark"></i></button>
                                    <hr/>
                                    <button type="submit" class="plus"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                    </header>
                    <section>
                        <div class="user">
                            <input id="user-name" name="user-name" value="Kubinb" readonly="readonly">
                            <i class="fa-solid fa-heart"></i>
                            <p id="likes"><?php echo $likes ?></p>
                        </div>
                        <div class="best-games">
                            <h2>Best games</h2>
                            <ul>
                                <?php $nr = 1 ?>
                                <?php
                                $a = 5;
                                foreach ($result as $game): ?>
                                <li>
                                    <div class="l_position">
                                        <div class="number">
                                            <p><?php echo $nr++?></p>
                                        </div>
                                        <div class="block">
                                            <img src="Public/img/game.webp">
                                            <p class="game-name">asd </p>
                                            <p class="rate"><?=$game->getRating();?></p>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </section>
                </form>
            </main>
        </div>
    </body>
</html>