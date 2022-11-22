<?php

class Game
{
    private $title;
    private $description;
    private $rating;
    private $hours_played;


    public function __construct($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    public function getHoursPlayed()
    {
        return $this->hours_played;
    }

    public function setHoursPlayed($hours_played): void
    {
        $this->hours_played = $hours_played;
    }


}