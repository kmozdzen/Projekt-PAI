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
            SELECT count(id) allgames, sum(rating) averagerating, sum(hours_played) hoursplayed FROM my_list WHERE id_user = :id;
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $s = new Stats(0 ,0 , 0, 0);
        foreach ($stats as $stat){
            $s->setAllGames($stat['allgames']);
            if($stat['averagerating'] != null)
                $s->setAverageRating($stat['averagerating']);
            else
                $s->setAverageRating(0);
            if($stat['averagerating'] != null)
                $s->setHoursPlayed($stat['hoursplayed']);
            else
                $s->setHoursPlayed(0);
        }

        if($s->getAllGames() != 0)
            $updatedAverageRating= $s->getAverageRating() / $s->getAllGames();
        else
            $updatedAverageRating = 0;

        $stmt = $this->database->connect()->prepare('
            UPDATE statistics SET "all_games" = :all_games, "average_rating" = :average_rating, "hours_played" = :hours_played WHERE id = (SELECT id_statistics FROM users WHERE id = :id);
        ');

        $stmt->bindParam(':all_games', $s->getAllGames(),  PDO::PARAM_INT);
        $stmt->bindParam(':average_rating', $updatedAverageRating, PDO::PARAM_INT);
        $stmt->bindParam(':hours_played', $s->getHoursPlayed(), PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

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

    public function likes(string $name, int $id){

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

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_likes WHERE id_user = :id and id_statistics = :id_statistics;
        ');

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_statistics", $idStat, PDO::PARAM_INT);
        $stmt->execute();
        $isLike = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$isLike){
            $stmt = $this->database->connect()->prepare('
            UPDATE statistics SET your_likes = your_likes + 1 WHERE id = :id
        ');

            $stmt->bindParam(":id", $idStat, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $this->database->connect()->prepare('
            INSERT INTO user_likes (id_statistics, id_user)
            VALUES (?, ?)
        ');

            $stmt->execute([
                $idStat,
                $id
            ]);

            $stmt = $this->database->connect()->prepare('
            SELECT * FROM statistics WHERE id = :idStat;
        ');
            $stmt->bindParam(":idStat", $idStat, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        }


    }

}