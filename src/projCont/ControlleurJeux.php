<?php
declare(strict_types=1);

namespace appbdd\projCont;

use appbdd\modele\Game;
use appbdd\modele\Utilisateurs;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class ControlleurJeux {
    private Container $container;

    public function __construct(Container $c)
    {
        $this->container = $c;

    }


    public function recupererJeuId(Request $rq, Response $rs, $args)
    {
        $jeu = Game::where('id', '=', $args['id'])->first();

        $tabJeu = ["id" => $jeu->id,
            "name" => $jeu->name,
            "alias" => $jeu->alias,
            "deck"  => $jeu->deck,
            "description" => $jeu->description,
            "original_elease_date" => $jeu->original_release_date
        ];

        $rs = $rs->withHeader('Content-Type', "application/json");
        $rs->getBody()->write(json_encode($tabJeu));
        return $rs;
    }


    public function recuperer200(Request $rq, Response $rs, $args)
    {
       $pageCour = intval($rq->getQueryParam('page',1));
        $tabJeu = [];
        //$jeux200 = Game::where("id", "<=", 200*$pageCour)->skip(200*$pageCour-200)->get();
        $jeux200 = Game::skip(($pageCour-1)*200)->take(200)->get();

        foreach ($jeux200 as $j) {
            $tab['game'] = [
                "id" => $j->id,
                "name" => $j->name,
                "alias" => $j->alias,
                "deck" => $j->deck
            ];
            $tabJeu[] = $tab;
        }
        $tabR =['Games' => $tabJeu];

        $next= $pageCour+1;
        $prev= $pageCour-1;
        $tabR['Links'] =  ['prev' => ['href' => __Dir__."api\games?page={$prev}"], 'next' => ['href' => __DIR__."api\games?page={$next}"]];


        $rs = $rs->withHeader('Content-Type', "application/json");
        $rs->getBody()->write(json_encode($tabR));
        return $rs;
    }

}
