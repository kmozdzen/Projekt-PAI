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
        $this->$mylistRepository = new MylistRepository();
    }

    public function addGame()
    {
        //to do
        /*$this->mylistRepository->addGame($game);*/
    }

}