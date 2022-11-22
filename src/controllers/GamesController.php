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
}