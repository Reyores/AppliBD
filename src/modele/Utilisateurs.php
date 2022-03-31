<?php
declare(strict_types=1);

// NAMESPACE
namespace appbdd\modele;

/**
 * Classe Item
 * Représente un item au sein de la base de données
 * Hérite de la classe Modele du module Eloquent
 */
class Utilisateurs extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    function commentaires(){
        return $this->hasMany(commentaires::class);
    }

}