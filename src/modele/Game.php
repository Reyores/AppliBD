<?php
declare(strict_types=1);

// NAMESPACE
namespace appbdd\modele;

/**
 * Classe Item
 * Représente un item au sein de la base de données
 * Hérite de la classe Modele du module Eloquent
 */
class Game extends \Illuminate\Database\Eloquent\Model
{

    // ATTRIBUTS

    public $timestamps = false;
    protected $table = 'game';
    protected $primaryKey = 'id';

    // CONSTRUCTEUR

    public function genre() {
        return $this->belongsToMany('Genre', 
                                    'Game2genre',
                                    'game_id',
                                    'genre_id');
    }

    public function platform() {
        return $this->belongsTo('Platform', 
                                'Game2platform',
                                'game_id',
                                'platform_id');
    }

    public function theme() {
        return $this->belongsToMany('Theme', 
                                    'Game2theme',
                                    'game_id',
                                    'theme_id');
    }

    public function company_dev() {
        return $this->belongsToMany('Company', 
                                    'Game_developers',
                                    'game_id',
                                    'comp_id');
    }

    public function company_publi() {
        return $this->belongsToMany('Company', 
                                    'Game_publishers',
                                    'game_id',
                                    'comp_id');
    }

    public function gameRating() {
        return $this->belongsToMany('Game_rating', 
                                    'Game2rating',
                                    'game_id',
                                    'rating_id');
    }

    public function character() {
        return $this->belongsToMany('Character', 
                                    'Game2character',
                                    'character_id',
                                    'game_id');
    }

}
