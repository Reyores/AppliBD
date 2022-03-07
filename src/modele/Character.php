<?php
declare(strict_types=1);

// NAMESPACE
namespace appbdd\modele;

/**
 * Classe Item
 * Représente un item au sein de la base de données
 * Hérite de la classe Modele du module Eloquent
 */
class Character extends \Illuminate\Database\Eloquent\Model
{

    // ATTRIBUTS

    public $timestamps = false;
    protected $table = 'character';
    protected $primaryKey = 'id';

    // CONSTRUCTEUR
    public function game() {
        return $this->belongsToMany('Game', 
                                    'Game2character',
                                    'game_id',
                                    'character_id');
    }

}
