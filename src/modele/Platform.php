<?php
declare(strict_types=1);

// NAMESPACE
namespace appbdd\modele;

/**
 * Classe Item
 * Représente un item au sein de la base de données
 * Hérite de la classe Modele du module Eloquent
 */
class Platform extends \Illuminate\Database\Eloquent\Model
{

    // ATTRIBUTS

    public $timestamps = false;
    protected $table = 'platform';
    protected $primaryKey = 'id';

    // CONSTRUCTEUR

    public function game() {
        return $this->belongsTo('Game', 
                                'Game2platform',
                                'platform_id',
                                'game_id');
    }

    public function company() {
        return $this->belongsTo('Company', 
                            'company_id');
    }

}
