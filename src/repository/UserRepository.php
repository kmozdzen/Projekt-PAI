<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Game.php';
require_once __DIR__.'/../models/Stats.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_user_details = ud.id WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );
    }

    public function addUser(User $user)
    {
        $stats = new Stats(0, 0, 0, 0);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO statistics (all_games, average_rating, hours_played, your_likes)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $stats->getAllGames(),
            $stats->getAverageRating(),
            $stats->getHoursPlayed(),
            $stats->getYourLikes()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_details (name, surname, phone)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details, id_statistics)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user),
            $this->getStatsId($stats),
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users_details WHERE name = :name AND surname = :surname AND phone = :phone
        ');
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->getPhone(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getStatsId(Stats $stats): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.statistics WHERE all_games = :all_games AND average_rating = :average_rating AND hours_played = :hours_played AND your_likes = :your_likes ORDER BY id DESC LIMIT 1 
        ');
        $stmt->bindParam(':all_games', $stats->getAllGames(), PDO::PARAM_STR);
        $stmt->bindParam(':average_rating', $stats->getAverageRating(), PDO::PARAM_STR);
        $stmt->bindParam(':hours_played', $stats->getHoursPlayed(), PDO::PARAM_STR);
        $stmt->bindParam(':your_likes', $stats->getYourLikes(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getUsers(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user){
            $result[] = new User(
                $user['email'],
                $user['password'],
                '',''
            );
        }

        return $result;
    }

    public function getUserByEmail(string $emailString){

        $stmt = $this->database->connect()->prepare('
            SELECT user FROM users WHERE email LIKE :add
        ');

        $stmt->bindParam(':add', $emailString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserStats($user_name) : array
    {
        $result = [];

       /* $stmt = $this->database->connect()->prepare('
            SELECT * FROM statistics WHERE id = (SELECT id_statistics FROM users WHERE email = :user_name)
        ');
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->execute();
        $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($stats as $stat){
            $result[] = $stat['your_likes'];
        }*/

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM my_list_view WHERE id_user = (SELECT id FROM users WHERE email = :user_name) ORDER BY -rating LIMIT 3
        ');
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($games as $game){
            $g = new Game(
                $game['title'],
                $game['rating'],
            );
            $g->setImage($game['image']);

            $result[] = $g;
        }
        return $result;
    }

    public function getLikes($user_name){
        $result = '';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM statistics WHERE id = (SELECT id_statistics FROM users WHERE email = :user_name)
        ');
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->execute();
        $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($stats as $stat){
            $result = $stat['your_likes'];
        }
        return $result;
    }
}