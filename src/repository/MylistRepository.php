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

    public function addGame(Game $game, $id): void
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


        $stmt = $this->database->connect()->prepare('
              SELECT * FROM users WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $idUser = 0;
        $idStats = 0;
        foreach ($users as $user){
            $idUser = $user['id'];
            $idStats = $user['id_statistics'];
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO my_list (rating, hours_played, added_at, id_games, id_user)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $game->getRating(),
            $game->getHoursPlayed(),
            $date->format('Y-m-d'),
            $idGames,
            $idUser
        ]);
    }

    public function getGames($id): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
              SELECT * FROM my_list_view WHERE id_user = (SELECT id FROM users WHERE id = :id) 

        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $my_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($my_list as $game){
            $g = new Game(
                $game['title'],
                $game['rating']);
            $g->setImage($game['image']);
            $result[] = $g;
        }

        return $result;
    }

}