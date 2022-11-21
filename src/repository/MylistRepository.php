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
        $stmt = $this->database->connect()->prepare('
            INSERT INTO my_list (rating, hours_played, added_at)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $game->getRating(),
            $game->getHoursPlayed(),
            $date->format('Y-m-d'),
        ]);
    }
}