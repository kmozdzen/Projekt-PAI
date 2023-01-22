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
        $id = $this->isAuthorized();
        $my_list = $this->mylistRepository->getGames($id);
        $this->render('mylist', ['my_list' => $my_list]);
    }

    public function addGame()
    {
        $id = $this->isAuthorized();
        if($this->isPost()){
            if($_POST['rating-text'] != null && $_POST['rating-text'] != "" &&
               $_POST['hours-text'] != null && $_POST['hours-text'] != "" &&
                $_POST['found-game'] != null && $_POST['found-game'] != "" &&
                $_POST['found-game'] != "Game"
            ){
                $rating = $_POST['rating-text'];
                $hours_played = $_POST['hours-text'];
                $id_games = $_POST['found-game'];

                $game = new Game($id_games, $rating);
                $game->setHoursPlayed($hours_played);
                $this->mylistRepository->addGame($game, $id);
                $this->render('search');
            }else{
                $this->render("search");
            }
        }
    }

    public function updateAllGames(){
        $this->mylistRepository->updateAllGames();
        http_response_code(200);
    }

}