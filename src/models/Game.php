<?php

class Game
{
    private $rating;
    private $hours_played;

    public function __construct($rating, $hours_played)
    {
        $this->rating = $rating;
        $this->hours_played = $hours_played;
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