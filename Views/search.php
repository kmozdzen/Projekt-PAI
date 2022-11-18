<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="Public/css/search.css"/>
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
                        <a href="#" class="button">Add game</a>
                    </li>
                    <li>
                        <a href="#" class="button">My list</a>
                    </li>
                    <li>
                        <a href="#" class="button">Statistics</a>
                    </li>
                    <li>
                        <a href="#" class="button">Users</a>
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
                        <input placeholder="Search for games">
                        <div class="icons">
                            <button><i class="fa-solid fa-xmark"></i></button>
                            <hr/>
                            <button><i class="fa-solid fa-plus"></i></button>
                        </div>    
                    </div>
                </header>
                <section class="add-game">
                    <div id="game">
                        <img src="Public/img/game.webp">
                        <h1 id="found-game">The Witcher: Wild Hunt</h1>
                    </div>
                    <div id="add">
                        <p id="rating">Rating : 5</p>
                        <p id="hours-played">Hours played: 192</p>
                        <i class="fa-solid fa-circle-plus"></i>
                    </div>                   
                </section>
            </main>
        </div>
    </body>
</html>