<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Game.php';
require_once __DIR__.'/../repository/GamesRepository.php';

class GamesController extends AppController
{
    private $gamesRepository;

    public function __construct()
    {
        parent::__construct();
        $this->gamesRepository = new GamesRepository();
    }

    public function search()
    {
        $games = $this->gamesRepository->getGames();
        $this->render('search', ['games' => $games]);
    }

    public function add(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->gamesRepository->getGameByTitle($decoded['add']));
        }

    }
}