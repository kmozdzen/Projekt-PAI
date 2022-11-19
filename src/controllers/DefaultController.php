<?php

require_once 'AppController.php';

class DefaultController extends AppController{
    public function index()
    {
        $this->render('login');
    }

    public function search()
    {
        $this->render('search');
    }

    public function mylist()
    {
        $this->render('mylist');
    }

    public function statistics()
    {
        $this->render('statistics');
    }

    public function users()
    {
        $this->render('users');
    }
}