<?php
declare(strict_types=1);


# Chargement de l'autoload
require_once __DIR__ . '/vendor/autoload.php';

use Carbon\Exceptions\Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Capsule\Manager as DB;

use appbdd\modele\Character;
use appbdd\modele\Company;
use appbdd\modele\Enemies;
use appbdd\modele\Friends;
use appbdd\modele\Game_developers;
use appbdd\modele\Game_publishers;
use appbdd\modele\Game_rating;
use appbdd\modele\Game;
use appbdd\modele\Game2character;
use appbdd\modele\Game2genre;
use appbdd\modele\Game2platform;
use appbdd\modele\Game2rating;
use appbdd\modele\Game2theme;
use appbdd\modele\Genre;
use appbdd\modele\Platform;
use appbdd\modele\Rating_board;
use appbdd\modele\Similar_games;
use appbdd\modele\Theme;



$db = new DB();
$db->addConnection(parse_ini_file(__DIR__.'/src/config/dbconfig.ini'));
$db->setAsGlobal();
$db->bootEloquent();



$time_start = microtime(true) ;
$req11 = Game::where('name','like', 'mario%' )->get();
$r1111 = Game_rating::where('name','like','%3+%')->get();
$time_end = microtime(true) ;
$time = $time_end - $time_start ;
echo "Le temps mis pour la requête est de : ".$time."<br>";

/*
foreach($req1 as $value){
    echo "Nom du jeu " . $value->name . "<br>";
    echo "Nom Perso : <br>";
    $r2 = $value->character()->get();
    foreach($r2 as $v){
        echo $v->name . '<br>';
    }
}*/



//$cr = new Genre();
//$cr->name = "Zeldiablo";
//$cr->deck = "Oui";
//$cr->description = "Description du Z";

//$cr->save();


