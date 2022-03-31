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
}
