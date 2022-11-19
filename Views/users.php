<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="Public/css/users.css"/>
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
                <header>
                    <div class="user-container">
                        <div class="typing-place">
                            <input type="text" placeholder="Search for users">
                        </div>
                        <div class="icons">
                            <button><i class="fa-solid fa-xmark"></i></button>
                            <hr/>
                            <button><i class="fa-solid fa-plus"></i></button>
                        </div>    
                    </div>
                </header>
                <section>
                    <div class="user">
                        <h1 id="user-name">Ronaldinho Gaucho</h1>
                        <i class="fa-solid fa-heart"></i>
                        <p id="likes">80</p>
                    </div>
                    <div class="best-games">
                        <h2>Best games</h2>
                        <ul>
                            <li>
                                <div class="l_position">
                                    <div class="number">
                                        <p>1</p>
                                    </div>
                                    <div class="block">
                                        <img src="Public/img/game.webp">
                                        <p class="game-name">The Witcher: Wild Hunt</p>
                                        <p class="rate">10</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="l_position">
                                    <div class="number">
                                        <p>2</p>
                                    </div>
                                    <div class="block">
                                        <img src="Public/img/game.webp">
                                        <p class="game-name">Grand Theft Auto: San Andrea</p>
                                        <p class="rate">9</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="l_position">
                                    <div class="number">
                                        <p>1</p>
                                    </div>
                                    <div class="block">
                                        <img src="Public/img/game.webp">
                                        <p class="game-name">The Witcher: Wild Hunt</p>
                                        <p class="rate">10</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>