<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Game.php';
require_once __DIR__ . '/../repository/StatisticsRepository.php';

class StatisticsController extends AppController
{
    private $statisticsRepository;

    public function __construct()
    {
        parent::__construct();
        $this->statisticsRepository = new StatisticsRepository();
    }

    public function statistics()
    {
        $statistics = $this->statisticsRepository->getStats();
        $this->render('statistics', ['statistics' => $statistics]);
    }

}