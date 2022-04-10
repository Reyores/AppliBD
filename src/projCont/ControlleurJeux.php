<?php
declare(strict_types=1);

namespace appbdd\projCont;

use appbdd\modele\Game;
use appbdd\modele\Game2platform;
use appbdd\modele\Platform;
use appbdd\modele\Utilisateurs;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class ControlleurJeux
{
    private Container $container;

    public function __construct(Container $c)
    {
        $this->container = $c;

    }

    /**
     * Methode qui affiche un jeu en fonction de l'args
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function recupererJeuId(Request $rq, Response $rs, $args)
    {
        $jeu = Game::where("id", "=", $args["id"])->first();

        $tab["game"] = ["id" => $jeu->id,
            "name" => $jeu->name,
            "alias" => $jeu->alias,
            "deck" => $jeu->deck,
            "description" => $jeu->description,
            "original_elease_date" => $jeu->original_release_date
        ];

        $tabP = Game2platform::where("game_id", "=", $args["id"])->get();


        $platforms = [];
        foreach ($tabP as $p) {
            $platform = Platform::where("id", "=", $p->platform_id)->first();


            $t["platform"] = ["id" => $platform->id,
                "name" => $platform->name,
                "alias" => $platform->alias,
                "abbreviation" => $platform->abbreviation,
            ];

            $t["links"] = ["self" => ["href" => $this->container->router->pathFor("pagePlatform", ["id" => $platform->id])]];

            array_push($platforms, $t);
        }
        $tab["platforms"] = $platforms;


        $tab["links"] = ["comments" => ["href" => $this->container->router->pathFor("pageCommentaire", ["id" => $jeu->id])],
            "characters" => ["href" => $this->container->router->pathFor("pageCharacters", ["id" => $jeu->id])]];

        $rs = $rs->withHeader('Content-Type', "application/json");
        $rs->getBody()->write(json_encode($tab));
        return $rs;
    }


    /**
     * Methode qui affiche une collection de 200 jeu en fonction de la page mis en args
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function recuperer200(Request $rq, Response $rs, $args)
    {
        $pageCour = intval($rq->getQueryParam("page", 1));
        $tabJeu = [];
        //$jeux200 = Game::where("id", "<=", 200*$pageCour)->skip(200*$pageCour-200)->get();
        $jeux200 = Game::skip(($pageCour - 1) * 200)->take(200)->get();

        foreach ($jeux200 as $jeu) {
            $tab["game"] = [
                "id" => $jeu->id,
                "name" => $jeu->name,
                "alias" => $jeu->alias,
                "deck" => $jeu->deck
            ];

            $tab["links"] = ["self" => ["href" => $this->container->router->pathFor("avoirJeux", ["id" => $jeu->id])]];

            $tabJeu[] = $tab;

        }
        $tabR = ['Games' => $tabJeu];

        $next = $pageCour + 1;
        $prev = $pageCour - 1;
        $tabR['Links'] = ['prev' => ['href' => __Dir__ . "api\games?page={$prev}"], 'next' => ['href' => __DIR__ . "api\games?page={$next}"]];


        $rs = $rs->withHeader('Content-Type', "application/json");
        $rs->getBody()->write(json_encode($tabR));
        return $rs;
    }

}
