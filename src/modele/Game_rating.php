<?php
declare(strict_types=1);

// NAMESPACE
namespace appbdd\modele;

/**
 * Classe Item
 * Représente un item au sein de la base de données
 * Hérite de la classe Modele du module Eloquent
 */
class Company extends \Illuminate\Database\Eloquent\Model
{

    // ATTRIBUTS

    public $timestamps = false;
    protected $table = 'game_rating';
    protected $primaryKey = 'id';

    // CONSTRUCTEUR
    public function game() {
        return $this->belongsToMany('Game', 
                                    'Game2rating',
                                    'rating_id',
                                    'game_id');
    }

    public function ratingBoard() {
        return $this->belongsTo('Rating_board', 
                                'RatingBoard_id');
    }

}
