<?php
require_once 'Repository.php';

class CookieRepository extends Repository
{
    public function createUserSession(int $id)
    {
        $token = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64)));
        $expire_time = time() + 86400;
        $expire_date = date('Y-m-d H:i:s', $expire_time);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_session (id, token, expire_date)
            VALUES (?, ?, ?)
            ON CONFLICT (id)
            DO UPDATE SET token = EXCLUDED.token, expire_date = EXCLUDED.expire_date;
        ');

        $stmt->execute([
            $id,
            $token,
            $expire_date,
        ]);

        setcookie("session_token", $token, $expire_time);
    }

    public function endUserSession()
    {
        if (isset($_COOKIE['session_token'])) {
            $stmt = $this->database->connect()->prepare('
            DELETE FROM user_session WHERE token = :token;
        ');
            $stmt->bindParam(':token', $_COOKIE['session_token']);
            $stmt->execute();

            setcookie('session_token', '', time() - 3600);
        }
    }


    public function getUserId(): ?int
    {
        $stmt = $this->database->connect()->prepare('
                SELECT id FROM user_session WHERE token = :token AND expire_date >= now();
        ');
        $stmt->bindParam(':token', $_COOKIE["session_token"]);
        $stmt->execute();

        $id = $stmt->fetchColumn();

        if (!$id) {
            throw new Exception("Invalid token");
        }

        return $id;
    }
}
