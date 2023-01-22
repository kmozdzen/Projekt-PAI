<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Game.php';
require_once __DIR__ . '/../models/Stats.php';

class StatRepository extends Repository
{

    public function getStats($id) : array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM statistics WHERE id = (SELECT id_statistics FROM users WHERE id = :id)
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($stats as $stat) {
            $result[] = new Stats(
                $stat['all_games'],
                $stat['average_rating'],
                $stat['hours_played'],
                $stat['your_likes'],
            );
        }


        return $result;
    }

    public function likes(string $name){


        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email
        ');

        $stmt->bindParam(':email', $name, PDO::PARAM_STR);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $idStat = 0;
        foreach ($users as $user) {
            $idStat = $user['id_statistics'];
        }

        echo $idStat;

        $stmt = $this->database->connect()->prepare('
            UPDATE statistics SET your_likes = your_likes + 1 WHERE id = :id
        ');

        $stmt->bindParam(":id", $idStat, PDO::PARAM_INT);
        $stmt->execute();

    }

}