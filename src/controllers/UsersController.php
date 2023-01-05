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
        $users = $this->userRepository->getUsers();
        $this->render('users', ['users' => $users]);
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
        if($this->isPost()) {
            print_r($_POST);
            $user_name = $_POST['show-user'];

            $result = $this->userRepository->getUserStats($user_name);
            $likes = $this->userRepository->getLikes($user_name);
            echo $likes;
            $this->render('users', ['result' => $result, 'likes' => $likes]);
        }
    }

}

