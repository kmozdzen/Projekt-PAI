<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class AdminController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function admin()
    {
        $this->isAdmin();
        $this->showUsers();
    }

    public function isAdmin(): int
    {
        $id_user = $this->isAuthorized();
        if ($this->userRepository->getRole($id_user) !== "admin") {
            http_response_code(401);
            exit;
        }
        return $id_user;
    }

    private function showUsers()
    {
        $users = $this->userRepository->getUsers();
        $this->render('admin', ['users' => $users]);
    }

    public function remove($id)
    {
        $this->isAdmin();
        $this->userRepository->remove($id);
        http_response_code(200);
    }
}