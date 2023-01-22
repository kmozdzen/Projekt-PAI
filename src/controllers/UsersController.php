<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Game.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class UsersController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function users()
    {
        $this->isAuthorized();
        $users = $this->userRepository->getUsers();
        $this->render('users', ['users' => $users]);
    }

    public function settings()
    {
        $id = $this->isAuthorized();
        $user = $this->userRepository->settings($id);
        $this->render('settings', ['user' => $user]);
    }


    public function add(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->userRepository->getUserByEmail($decoded['add']));
        }

    }

    public function getUserStats()
    {
        $this->isAuthorized();
        if($this->isPost()) {
            $user_name = $_POST['show-user'];

            $result = $this->userRepository->getUserStats($user_name);
            $likes = $this->userRepository->getLikes($user_name);
            $this->render('users', ['result' => $result, 'likes' => $likes, 'name' => $user_name]);
        }
    }

    public function changeData(){
        $id = $this->isAuthorized();
        if (!$this->isPost()) {
            return $this->render('settings');
        }


        $email = $_POST['new-email'];
        $password = $_POST['new-password'];
        $confirmedPassword = $_POST['new-confirmedPassword'];
        $name = $_POST['new-name'];
        $surname = $_POST['new-surname'];
        $phone = $_POST['new-phone'];

        $oldUser = $this->userRepository->settings($id);
        if ($password !== $confirmedPassword) {
            return $this->render('settings', ['messages' => ['Please provide proper password'], 'user' => $oldUser]);
        }

        //TODO try to use better hash function
        $user = new User($email, md5($password), $name, $surname);
        $user->setPhone($phone);

        $this->userRepository->changeData($user, $id);

        $oldUser = $this->userRepository->settings($id);
        return $this->render('settings', ['messages' => ['Succesfully changed data!'], 'user' => $oldUser]);
    }

}

