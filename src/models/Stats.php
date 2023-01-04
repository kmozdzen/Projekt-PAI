<?php

class Stats
{
    private $all_games;
    private $average_rating;
    private $hours_played;
    private $your_likes;

    public function __construct($all_games, $average_rating, $hours_played, $your_likes)
    {
        $this->all_games = $all_games;
        $this->average_rating = $average_rating;
        $this->hours_played = $hours_played;
        $this->your_likes = $your_likes;
    }

    public function getAllGames()
    {
        return $this->all_games;
    }

    public function setAllGames($all_games): void
    {
        $this->all_games = $all_games;
    }

    public function getAverageRating()
    {
        return $this->average_rating;
    }

    public function setAverageRating($average_rating): void
    {
        $this->average_rating = $average_rating;
    }

    public function getHoursPlayed()
    {
        return $this->hours_played;
    }

    public function setHoursPlayed($hours_played): void
    {
        $this->hours_played = $hours_played;
    }

    public function getYourLikes()
    {
        return $this->your_likes;
    }


    public function setYourLikes($your_likes): void
    {
        $this->your_likes = $your_likes;
    }


}