<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Stats.php';

class StatisticsRepository extends Repository
{
    public function getStats()
    {
        $emailString = '';

        if(isset($_COOKIE['email'])){
            echo $_COOKIE['email'];
            $emailString = $_COOKIE['email'];
        }

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM statistics WHERE id = (SELECT id_statistics FROM users WHERE email LIKE :email)
        ');

        $stmt->bindParam(':email', $emailString, PDO::PARAM_STR);
        $stmt->execute();
        $stats= $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo $stats['all_games'];

        $s= new Stats(
            2,
            16,
            4,
            1);

        $result = $s;

        return $result;
    }
}