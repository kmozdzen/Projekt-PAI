<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="Public/css/search.css"/>
        <title>YourGameBook</title>
        <script src="https://kit.fontawesome.com/3ff5952e8a.js" crossorigin="anonymous"></script>
        <script src="Public/js/add.js" type="text/javascript" defer></script>
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
                <header>
                    <div class="search-container">
                        <input type="text" placeholder="Search for games" list="scripts">
                        <datalist id="scripts">
                            <?php foreach ($games as $game): ?>
                                <option><?= $game->getTitle(); ?></option>
                            <?php endforeach; ?>
                        </datalist>
                        <div class="icons">
                            <button><i class="fa-solid fa-xmark"></i></button>
                            <hr/>
                            <button id="plus"><i class="fa-solid fa-plus"></i></button>
                        </div>    
                    </div>
                </header>
                <section class="add-game">
                    <div id="game">
                        <img src="Public/img/game.webp">
                        <h1 id="found-game">Game</h1>
                    </div>
                    <div id="add">
                        <p id="rating">Rating: -</p>
                        <p id="hours-played">Hours played: -</p>
                        <i class="fa-solid fa-circle-plus"></i>
                    </div>                   
                </section>
            </main>
        </div>
    </body>
</html>
