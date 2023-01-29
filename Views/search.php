<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="Public/css/search.css"/>
        <title>YourGameBook</title>
        <script src="https://kit.fontawesome.com/3ff5952e8a.js" crossorigin="anonymous"></script>
        <script src="Public/js/add.js" type="text/javascript" defer></script>
        <script src="Public/js/field.js" type="text/javascript" defer></script>
    </head>
    <body>
        <div class="base-container">
            <nav>
                <nav>
                    <?php include('nav.php')?>
                </nav>
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
                            <i class="fa-solid fa-xmark"></i>
                            <hr/>
                            <i class="fa-solid fa-plus"></i>
                        </div>    
                    </div>
                </header>
                <section class="add-game">
                    <form action="addGame" method="POST" ENCTYPE="multipart/form-data">
                        <div id="game">
                            <img id="game-img" src="Public/img/game.webp">
                            <input id="found-game" name="found-game" value="Game" readonly="readonly">
                        </div>
                        <div id="add">
                                <p id="rating">
                                    Rating:
                                    <select name="rating-text" class="rating-text">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </p>
                                <p id="hours-played">
                                    Hours played:
                                    <input name="hours-text" class="hours-text" type="number" min="0" value="0">
                                </p>
                                <button><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
        <div class="phone-nav">
            <ul>
                <li>
                    <a href="search" class="button-icon"><i class="fa-solid fa-plus"></i></a>
                </li>
                <li>
                    <a href="mylist" class="button-icon"><i class="fa-solid fa-table-list"></i></a>
                </li>
                <li>
                    <a href="statistics" class="button-icon"><i class="fa-solid fa-layer-group"></i></a>
                </li>
                <li>
                    <a href="users" class="button-icon"><i class="fa-solid fa-user"></i></a>
                </li>
            </ul>
        </div>
    </body>
</html>

<template id="game-template">
    <div id="">
        <img id="" src="">
        <input id="" name="found-game" value="" readonly="readonly">
    </div>
</template>