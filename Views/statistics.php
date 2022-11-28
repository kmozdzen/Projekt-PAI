<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="Public/css/statistics.css"/>
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
                <ul>
                    <li>
                        <div class="stats">
                            <h1>All games</h1>
                            <hr>
                            <p id="all-games">17</p>
                        </div>
                    </li>
                    <li>
                        <div class="stats">
                            <h1>Average rating</h1>
                            <hr>
                            <p id="average">7.0</p>
                        </div>
                    </li>
                    <li>
                        <div class="stats">
                            <h1>Hours played</h1>
                            <hr>
                            <p id="hours">349</p>
                        </div>
                    </li>
                    <li>
                        <div class="stats">
                            <div class="likes-name">
                                <h1>Your likes</h1>
                                <i class="fa-solid fa-heart"></i>
                            </div>
                            <hr>
                            <p id="likes">43</p>
                        </div>
                    </li>
                </ul>
            </main>
        </div>
    </body>
</html>