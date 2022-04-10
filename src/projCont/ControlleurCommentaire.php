<?php
declare(strict_types=1);


namespace appbdd\projCont;

use appbdd\modele\Commentaires;
use appbdd\modele\Game;
use appbdd\modele\Utilisateurs;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class ControlleurCommentaire
{

    private Container $container;

    public function __construct(Container $c)
    {
        $this->container = $c;

    }

    public function recupererCollectionCom(Request $rq, Response $rs, array $args)
    {
        $commentaires = Commentaires::where("game", "=", $args["id"])->get();
        $tabRes = [];

        foreach ($commentaires as $c) {
            $tab = ["id" => $c->id,
                "titre" => $c->titre,
                "contenue" => $c->contenue,
                "dateCreation" => $c->created_at,
                "nomUtilisateur" => $c->postedBy
            ];


            $tabRes[] = $tab;
        }

        $comments["comments"]=$tabRes;
        $rs = $rs->withHeader("Content-Type", "application/json");
        $rs->getBody()->write(json_encode($comments));
        return $rs;

    }
}