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

use appbdd\projCont\ControlleurJeux;
use appbdd\projCont\ControlleurCommentaire;
use appbdd\projCont\ControlleurCharacter;
use appbdd\projCont\ControlleurPlatform;



use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;

# Installation de la configuration erreur de Slim
$config = ['settings' => ['displayErrorDetails' => true, 'dbconfig' => __DIR__.'/src/config/dbconfig.ini']];

$db = new DB();
$db->addConnection(parse_ini_file(__DIR__.'/src/config/dbconfig.ini'));
$db->setAsGlobal();
$db->bootEloquent();
DB::enableQueryLog();


$container = new Container($config);
$app = new App($container);


########    LES ROUTES  #######


//Partie 1
$app->get('/api/games/{id}[/]', function (Request $rq, Response $rs, array $args) use ($container): Response {
    $controleur = new ControlleurJeux($container);
    return $controleur->recupererJeuId($rq, $rs, $args);
})->setName('avoirJeux');



//Partie 2
$app->get('/api/games[/]', function (Request $rq, Response $rs, array $args) use ($container): Response {
    $controleur = new ControlleurJeux($container);
    return $controleur->recuperer200($rq, $rs, $args);
})->setName('pageJeux');



//Partie 5
$app->get('/api/games/{id}/comments[/]', function (Request $rq, Response $rs, array $args) use ($container): Response {
    $controleur = new ControlleurCommentaire($container);
    return $controleur->recupererCollectionCom($rq, $rs, $args);
})->setName('pageCommentaire');

$app->post('/api/games/{id}/comments[/]', function (Request $rq, Response $rs, array $args) use ($container): Response {
    $controleur = new ControlleurCommentaire($container);
    return $controleur->ajouterCommentaire($rq, $rs, $args);
})->setName('pageCommentaire');


//Partie 6
$app->get('/api/games/{id}/characters[/]', function (Request $rq, Response $rs, array $args) use ($container): Response {
    $controleur = new ControlleurCharacter($container);
    return $controleur->collectionCharacterJeu($rq, $rs, $args);
})->setName('pageCharacters');


$app->get('/api/platforms/{id}[/]', function (Request $rq, Response $rs, array $args) use ($container): Response {
    $controleur = new ControlleurPlatform($container);
    return $controleur->platformJeu($rq, $rs, $args);
})->setName('pagePlatform');


//Partie 7
$app->get('/api/characters/{id}[/]', function (Request $rq, Response $rs, array $args) use ($container): Response {
    $controleur = new ControlleurCharacter($container);
    return $controleur->characterJeu($rq, $rs, $args);
})->setName('pageCharacter');

$app->run();


