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
                            <button><i class="fa-solid fa-xmark"></i></button>
                            <hr/>
                            <button id="plus"><i class="fa-solid fa-plus"></i></button>
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
                                    <input name="rating-text" id="rating-text" type="number">
                                    <!--<select id="rating-text">
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
                                    </select>-->
                                </p>
                                <p id="hours-played">
                                    Hours played:
                                    <input name="hours-text" id="hours-text" type="number" min="0">
                                </p>
                                <button><i class="fa-solid fa-circle-plus"></i></button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </body>
</html>

<template id="game-template">
    <div id="">
        <img id="" src="">
        <input id="" name="found-game" value="" readonly="readonly">
    </div>
</template>