<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Game.php';
require_once __DIR__ . '/../models/Stats.php';

class StatRepository extends Repository
{

    public function getStats() : array
    {
        $email = '';
        $result = [];

        if(isset($_COOKIE['email'])){
            echo $_COOKIE['email'];
            $email = $_COOKIE['email'];
        }

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM statistics WHERE id = (SELECT id_statistics FROM users WHERE email = :email)
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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

        echo $result[0]->getAllGames();

        return $result;
    }

}