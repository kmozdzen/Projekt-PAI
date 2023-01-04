<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Game.php';

class GamesRepository extends Repository
{

   /* public function getGame(string $id): ?Game
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
            $game['title']
        );
    }*/

    public function getGames(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM games WHERE added = false
        ');
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($games as $game){


            $result[] = new Game(
                $game['title'],
                $game['rating'],
            );
        }

        return $result;
    }

    public function getGameByTitle(string $searchString){

        $stmt = $this->database->connect()->prepare('
            SELECT game FROM games WHERE title LIKE :add
        ');

        $stmt->bindParam(':add', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}