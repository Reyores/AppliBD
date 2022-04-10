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
            $user = Utilisateurs::where('email', '=', $c->postedBy)->first();
            $tab = ["id" => $c->id,
                "titre" => $c->titre,
                "contenue" => $c->contenue,
                "created_at" => $c->created_at,
                "Nom" => $user->nom,
            ];


            $tabRes[] = $tab;
        }

        $comments["comments"] = $tabRes;
        $rs = $rs->withHeader("Content-Type", "application/json");
        $rs->getBody()->write(json_encode($comments));
        return $rs;

    }

    public function ajouterCommentaire(Request $rq, Response $rs, $args)
    {
        $donnees = $rq->getParsedBody();

        $email = filter_var($donnees["email"], FILTER_SANITIZE_EMAIL);
        $user = Utilisateurs::where("email", "=", $email)->first();

        $jeu = Game::where("id", "=", $args["id"])->first();
        $c = new Commentaires();

        $c->titre = filter_var($donnees["titre"], FILTER_SANITIZE_STRING);
        $c->contenue = filter_var($donnees["contenue"], FILTER_SANITIZE_STRING);
        $c->postedBy = $user->nom;
        $c->game = filter_var($jeu->id, FILTER_SANITIZE_NUMBER_INT);

        $c->save();

        $rs = $rs->withHeader("Content-Type", "application/json");

        $rs = $rs->withStatus(201);


        $tab['comments'] = ["href" => $this->container->router->pathFor("pageCharacters", ["id" => $args['id']])];

        $rs->getBody()->write(json_encode($tab));
        return $rs;
    }
}