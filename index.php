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
use appbdd\modele\Utilisateurs as User;
use appbdd\modele\Commentaires;



$db = new DB();
$db->addConnection(parse_ini_file(__DIR__.'/src/config/dbconfig.ini'));
$db->setAsGlobal();
$db->bootEloquent();
DB::enableQueryLog();

$date = new DateTime('2022-01-01T15:03:01.012345Z');
$date->format("Y-m-d(H:M)");
$faker = Faker\Factory::create();

        for($i=0;$i<250000;$i++){

            $c = new Commentaires();

            //id	title	content	created_at	updated_at	postedBy	game	
            $title;
            $content;
            $created_at;
            $updated_at;
            $postedBy;
            $game;

            $games = Game::count();
            $users = User::count();
            $game = rand(1,$games);

            
            $title = $faker->title();
            $content = $faker->realText();
            $created_at = $faker->date($faker->date());
            $updated_at = $faker->date($faker->date());
            $postedBy = rand(1,$users);
            
            echo $title . "<br>";
            echo $content . "<br>";
            echo $created_at . "<br>";
            echo $updated_at . "<br>";
            echo $postedBy . "<br>";
            echo $game . "<br>";

            $c->titre = $title;
            $c->contenue = $content;
            $c->created_at = $created_at;
            $c->updated_at = $updated_at;
            $c->postedBy = $postedBy;
            $c->id = $game;

            $c->save();
            
            echo "______________________ " . $i . "______________________ <br>";
        }


/*
$fakerFr = Faker\Factory::create('fr_FR');
$fakerIt = Faker\Factory::create('it_IT');
$fakerEs = Faker\Factory::create('es_ES');
$fakerEn = Faker\Factory::create();
for($i=0;$i<25000;$i++){

    $u = new User();


    $prenom;
    $nom;
    $adresse;
    $email;
    $telephone;
    $date;



    switch (rand(0,10)){
        case 1:
            echo "français :" . "<br>";
            $prenom = $fakerFr->firstName();
            $nom = $fakerFr->lastName();
            $adresse = $fakerFr->address();
            $email = $fakerFr->email();
            $telephone = $fakerFr->phoneNumber();
            $date = $fakerFr->date();

            break;
        case 2:
            echo "Italien :" . "<br>";
            $prenom = $fakerIt->firstName();
            $nom = $fakerIt->lastName();
            $adresse = $fakerIt->address();
            $email = $fakerIt->email();
            $telephone = $fakerIt->phoneNumber();
            $date = $fakerIt->date();

            break;
        case 3:
            echo "Espagnol :" . "<br>";
            $prenom = $fakerEs->firstName();
            $nom = $fakerEs->lastName();
            $adresse = $fakerEs->address();
            $email = $fakerEs->email();
            $telephone = $fakerEs->phoneNumber();
            $date = $fakerEs->date();

            break;
        default:
            echo "Englais :" . "<br>";
            $prenom = $fakerEn->firstName();
            $nom = $fakerEn->lastName();
            $adresse = $fakerEn->address();
            $email = $fakerEn->email();
            $telephone = $fakerEn->phoneNumber();
            $date = $fakerEn->date();
            break;
    }

    echo $prenom . "<br>";
    echo $nom . "<br>";
    echo $adresse . "<br>";
    echo $email . "<br>";
    echo $telephone . "<br>";
    echo $date . "<br>";


    $u->prenom = $prenom;
    $u->nom = $nom;
    $u->adresse = $adresse;
    $u->email = $email;
    $u->telephone = $telephone;
    $u->dateNaissance = date($date);

    $u->save();

    echo "______________________ " . $i . "______________________ <br>";
}*/
/*
$date = new DateTime('2022-01-01T15:03:01.012345Z');
$date->format("Y-m-d(H:M)");

$utilisateur1 = new User();

$commentaire1Utilisateur1 = new Commentaires();
$commentaire2Utilisateur1 = new Commentaires();
$commentaire3Utilisateur1 = new Commentaires();

$utilisateur1->email = 'boulet@gmail.com';
$utilisateur1->nom = 'Blanchard';
$utilisateur1->prenom = 'Loic';
$utilisateur1->adresse = 'avenue des boulets';
$utilisateur1->telephone = '0698529569 ';
$utilisateur1->dateNaissance = date('2002-15-03 16:15:00');
$utilisateur1->save();


$commentaire1Utilisateur1->titre = "Avis";
$commentaire1Utilisateur1->contenue = 'J ai troué mon caleçon après avoir joué à ce jeu';
$commentaire1Utilisateur1->postedBy = 'boulet@gmail.com';
$commentaire1Utilisateur1->game = 12342;


$commentaire2Utilisateur1->titre = 'Bug';
$commentaire2Utilisateur1->contenue = 'Le niveau deux à un bug d affichage au niveau de la montagne';
$commentaire2Utilisateur1->postedBy = 'boulet@gmail.com';
$commentaire2Utilisateur1->game = 12342;


$commentaire3Utilisateur1->titre = 'Ajouter ça svp';
$commentaire3Utilisateur1->contenue = 'Je veux pouvoir date la vielle dame';
$commentaire3Utilisateur1->postedBy = 'boulet@gmail.com';
$commentaire3Utilisateur1->game = 12342;

$commentaire1Utilisateur1->save();
$commentaire2Utilisateur1->save();
$commentaire3Utilisateur1->save();

$utilisateur2 = new User();
$commentaire1Utilisateur2 = new Commentaires();
$commentaire2Utilisateur2 = new Commentaires();
$commentaire3Utilisateur2 = new Commentaires();

$utilisateur2->email = 'aled@gmail.com';
$utilisateur2->nom = 'Renard';
$utilisateur2->prenom = 'Guillaume';
$utilisateur2->adresse = 'maison de loic';
$utilisateur2->telephone = '0696699669';
$utilisateur2->dateNaissance = date('2002-06-03 11:52:00');
$utilisateur2->save();

$commentaire1Utilisateur2->titre = 'Mon avis';
$commentaire1Utilisateur2->contenue = 'tro bi1';
$commentaire1Utilisateur2->postedBy = 'aled@gmail.com';
$commentaire1Utilisateur2->game = 12342;


$commentaire2Utilisateur2->titre = 'La musique';
$commentaire2Utilisateur2->contenue = 'jador la music des konbas';
$commentaire2Utilisateur2->postedBy = 'aled@gmail.com';
$commentaire2Utilisateur2->game = 12342;


$commentaire3Utilisateur2->titre = 'qui veut jouer';
$commentaire3Utilisateur2->contenue = 'mp mwa si vou voulai jouait avec mwa';
$commentaire3Utilisateur2->postedBy = 'aled@gmail.com';
$commentaire3Utilisateur2->game = 12342;

$commentaire1Utilisateur2->save();
$commentaire2Utilisateur2->save();
$commentaire3Utilisateur2->save();


*/

   
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
/*
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
*/