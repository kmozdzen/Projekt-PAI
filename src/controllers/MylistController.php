<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Game.php';
require_once __DIR__.'/../repository/MylistRepository.php';

class MylistController extends AppController
{
    private $mylistRepository;

    public function __construct()
    {
        parent::__construct();
        $this->mylistRepository = new MylistRepository();
    }

    public function mylist()
    {
        $my_list = $this->mylistRepository->getGames();
        $this->render('mylist', ['my_list' => $my_list]);
    }

    public function addGame()
    {
        if($this->isPost()){
            $rating = $_POST['rating-text'];
            $hours_played = $_POST['hours-text'];
            $id_games = $_POST['found-game'];

            $game = new Game($id_games, $rating);
            $game->setHoursPlayed($hours_played);
            $this->mylistRepository->addGame($game);
            $this->render('search');
        }
    }

    public function updateAllGames(){
        $this->mylistRepository->updateAllGames();
        http_response_code(200);
    }

}