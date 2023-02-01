<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';


class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $user = $this->userRepository->getUser($email);
        } catch (Exception $exception) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $this->cookieRepository->createUserSession($user->getId());

        $url = "http://$_SERVER[HTTP_HOST]";

        if($user->getRole() == "admin"){
            header("Location: {$url}/admin");
        }else
        {
            header("Location: {$url}/search");
        }
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];

        foreach ($_POST as $place) {
            if ($this->validate($place)) {
                return $this->render('register', ['messages' => ['Received invalid request!']]);
            }
        }

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $name, $surname);
        $user->setPhone($phone);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function logout()
    {
        $this->cookieRepository->endUserSession();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }

    private function validate(string $place): bool
    {
        return $place == null || $place == "" || strlen($place) > 64;
    }
}