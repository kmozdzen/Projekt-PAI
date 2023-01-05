<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Game.php';

class MylistRepository extends Repository
{

    public function getGame(string $id): ?Game
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM game WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $game = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($game == false) {
            return null;
        }

        return new Game(
            $game['rating'],
            $game['hours_played'],
        );
    }

    public function addGame(Game $game): void
    {
        $date = new DateTime();
        $title = $game->getTitle();

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games WHERE title = :title
        ');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        $isGame = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $idGames = 0;

        foreach ($isGame as $g){
            $idGames = $g['id'];
        }

        /*$stmt = $this->database->connect()->prepare('
            UPDATE games SET added = true WHERE id = :id
        ');
        $stmt->bindParam(':id', $idGames, PDO::PARAM_INT);
        $stmt->execute();*/


        $stmt = $this->database->connect()->prepare('
            INSERT INTO my_list (rating, hours_played, added_at, id_games, id_user)
            VALUES (?, ?, ?, ?, ?)
        ');

        $idUser = 4;

        $stmt->execute([
            $game->getRating(),
            $game->getHoursPlayed(),
            $date->format('Y-m-d'),
            $idGames,
            $idUser
        ]);
    }

    public function getGames(): array
    {
        $result = [];

        $mail = $_COOKIE['email'];
        echo $mail;

        /*$stmt = $this->database->connect()->prepare('
            SELECT title, rating, hours_played, image FROM my_list JOIN games g on g.id = my_list.id_games order by -rating
        ');
        $stmt->execute();
        $my_list = $stmt->fetchAll(PDO::FETCH_ASSOC);*/

        $stmt = $this->database->connect()->prepare('
              SELECT rating, hours_played FROM my_list WHERE id_user = (SELECT id FROM users WHERE email = :mail) 

        ');
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        $my_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($my_list as $game){
            $g = new Game(
                $game['title'],
                $game['rating']);
            $g->setImage($game['image']);
            echo $g->getImage();
            $result[] = $g;
        }

        return $result;
    }

    public function updateAllGames(){
        $stmt = $this->database->connect()->prepare('
            UPDATE statistics SET "all_games" = "all_games" + 1;
        ');

        $stmt->execute();
    }

}