<?php
declare(strict_types=1);

// NAMESPACE
namespace appbdd\modele;

/**
 * Classe Item
 * Représente un item au sein de la base de données
 * Hérite de la classe Modele du module Eloquent
 */
class Commentaires extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'commentaires';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(Utilisateurs::class);
    }

    public function game(){
        return $this->belongsTo(Game::class);
    }
}