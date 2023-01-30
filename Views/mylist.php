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
                <?php include('nav.php')?>
            </nav>
            <main>
                <div class="my_list">
                    <p>My list</p>
                </div>
                <div class="list">
                    <ul>
                        <?php $nr = 1 ?>
                        <?php
                        $a = 5;
                        foreach ($my_list as $game): ?>
                            <li>
                                <div class="l_position">
                                    <div class="number">
                                        <p><?php echo $nr++?></p>
                                    </div>
                                    <div class="block">
                                        <img src="Public/img/<?=$game->getImage();?>" alt=<?=$game->getImage();?>>
                                        <p class="game-name"><?=$game->getTitle();?></p>
                                        <p class="rate"><?=$game->getRating();?></p>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </main>
        </div>
        <?php include('nav-phone.php') ?>
    </body>
</html>
