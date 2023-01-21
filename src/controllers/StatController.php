<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/Game.php';
require_once __DIR__ . '/../repository/StatRepository.php';

class StatController extends AppController
{
    private $statRepository;

    public function __construct()
    {
        parent::__construct();
        $this->statRepository = new StatRepository();
    }

    public function statistics(){
        $stats = $this->statRepository->getStats();
        $this->render('statistics', ['stats' => $stats]);
    }

    public function likes(string $name){

        $this->statRepository->likes($name);
        http_response_code(200);
    }
}

