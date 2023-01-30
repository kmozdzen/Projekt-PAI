<?php
require_once __DIR__.'/../repository/CookieRepository.php';

class AppController{

    private $request;
    protected $cookieRepository;

    public function __construct()
    {
        $this->cookieRepository = new CookieRepository();
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'Views/'. $template.'.php';
        $output = 'File not found';
                
        if(file_exists($templatePath)){
            extract($variables);
            
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }

    protected function isAuthorized(): int
    {
        if (isset($_COOKIE["session_token"])) {
            try {
                return $this->cookieRepository->getUserId();
            } catch (Exception $exception) {
                http_response_code(401);
                exit;
            }
        } else {
            http_response_code(401);
            exit;
        }
    }
}