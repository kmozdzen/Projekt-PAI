<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Game.php';
require_once __DIR__.'/../models/Stats.php';

class UserRepository extends Repository
{

    /**
     * @throws Exception
     */
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id, name, surname, email, password, id_role FROM users u JOIN users_details ud 
            ON u.id_user_details = ud.id WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception("User not found");
        }

        $u = new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $this->getRole($user['id_role']));

        $u->setId($user['id']);

        return $u;
    }

    public function getRole(int $id): string
    {
        $stmt = $this->database->connect()->prepare('
            SELECT name FROM role WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
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
            INSERT INTO users (email, password, id_user_details, id_statistics, id_role)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user),
            $this->getStatsId($stats),
            $this->getIdRole($user->getRole())
        ]);
    }

    public function getIdRole(string $name): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id FROM role WHERE name = :name
        ');
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetchColumn();
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
            SELECT u.id, email, password, name, surname FROM users u JOIN users_details ud on u.id_user_details = ud.id WHERE id_role = 2
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $u = new User(
                $user['email'],
                $user['password'],
                $user['name'],
                $user['surname']
            );
            $u->setId($user['id']);
            $result[] = $u;
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

    public function changeData($user, $id)
    {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u JOIN users_details ud ON u.id_user_details = ud.id WHERE u.id = :id;
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $oldUser = new User("", "", "", "");
        $idStats = 0;
        foreach ($users as $u){
            $oldUser->setEmail($u['email']);
            $oldUser->setPassword($u['password']);
            $oldUser->setName($u['name']);
            $oldUser->setSurname($u['surname']);
            $oldUser->setPhone($u['phone']);
            $idStats = $u['id_user_details'];
        }

        if ($this->validate($user->getEmail())){
            $user->setEmail($oldUser->getEmail());
        }
        if ($this->validate($user->getPassword())){
            $user->setPassword($oldUser->getPassword());
        }
        if ($this->validate($user->getName())){
            $user->setName($oldUser->getName());
        }
        if ($this->validate($user->getSurname())){
            $user->setSurname($oldUser->getSurname());
        }
        if ($this->validate($user->getPhone())){
            $user->setPhone($oldUser->getPhone());
        }

        $stmt = $this->database->connect()->prepare('
            UPDATE users_details SET name = :name, surname = :surname, phone = :phone WHERE id = :id;
        ');

        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->getPhone(), PDO::PARAM_STR);
        $stmt->bindParam(':id', $idStats, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $this->database->connect()->prepare('
            UPDATE users SET email = :email, password = :password WHERE id = :id;
        ');

        $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function settings($id) : User
    {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u JOIN users_details ud ON u.id_user_details = ud.id WHERE u.id = :id;
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $user = new User("", "", "", "");
        foreach ($users as $u){
            $user->setEmail($u['email']);
            $user->setPassword($u['password']);
            $user->setName($u['name']);
            $user->setSurname($u['surname']);
            $user->setPhone($u['phone']);
        }
        return $user;
    }

    private function validate(string $place): bool
    {
        return $place == NULL || $place == "" || strlen($place) > 64;
    }

    public function remove($id){
        $stmt = $this->database->connect()->prepare('
            DELETE FROM users WHERE id = :id;
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}