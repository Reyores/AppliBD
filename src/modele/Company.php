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
    protected $table = 'company';
    protected $primaryKey = 'id';

    // CONSTRUCTEUR
    public function game_dev() {
        return $this->belongsToMany('Game', 
                                    'Game_developers',
                                    'comp_id',
                                    'game_id');
    }

    public function game_publi() {
        return $this->belongsToMany('Game', 
                                    'Game_publishers',
                                    'comp_id',
                                    'game_id');
    }

}
