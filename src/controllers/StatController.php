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
        $id = $this->isAuthorized();
        $stats = $this->statRepository->getStats($id);
        $this->render('statistics', ['stats' => $stats]);
    }

    public function likes(){
        $id = $this->isAuthorized();

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->statRepository->likes($decoded['userName'], $id));
        }
    }
}

