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
DB::enableQueryLog();


//$time_start = microtime(true) ;
//$r1111 = Game_rating::where('name','like','%3+%')->get();
//$req11 = Company::where('location_country','=','United kingdom');
//$time_end = microtime(true) ;
//$time = $time_end - $time_start ;
//echo "Le temps mis pour la requête est de : ".$time."<br>";

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


/*  
$reqMario = Game::where('name','like', '%Mario%' )->get();


$reqjeu = Game::find(12342);
foreach($reqjeu->character as $personnage){
    echo("Nom du personnage: " . $personnage->name . "<br>". "Deck du personnage: " . $personnage->deck . "<br><br>");
}
*/
/*
$gameMario = Game::where("name","like","%Mario%")->get();
foreach($gameMario as $jeu){
    foreach($jeu->character as $perso ){
        if($perso->first_appeared_in_game_id == $jeu->id){
            echo ("nom : " . $perso->name.'<br><br>');
        }
    }
}
*/
/*
$game = Game::where('name','like', '%mario%' )->with('character')->get();
foreach($game as $value){
    $r2 = $value->character;
    foreach($r2 as $v){
        echo $v->name . '<br>';
    }
} */

$company = Company::where('name','like','%Sony%')->with('game_dev')->get();
echo " Liste des jeux fait par <br> <br>";
foreach($company as $value){
    $r = $value->game_dev;
    foreach($r as $v){
        echo($v->name . "<br>");    
    }
    echo"<br><br>";
}
$compteur = 0;
foreach( DB::getQueryLog() as $q){
    $compteur++;
    echo "-------------- <br>";
    echo "query : " . $q['query'] ."<br>";
    echo "bindings : [";
    foreach ($q['bindings'] as $b ) {
        echo " ". $b."," ;
    }
    echo " ] <br><br>";
};
echo 'Nombre de requêtes executées : ' . $compteur;
