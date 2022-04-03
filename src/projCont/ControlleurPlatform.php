<?php
declare(strict_types=1);

namespace appbdd\projCont;


use appbdd\modele\Game;
use appbdd\modele\Platform;
use appbdd\modele\Utilisateurs;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class ControlleurPlatform
{


    private Container $container;

    public function __construct(Container $c)
    {
        $this->container = $c;

    }

    public function platformJeu(Request $rq, Response $rs, array $args) {

        $pla = Platform::where("id", "=", $args["id"])->first();

        $tab["platfom"] = ["id" => $pla->id,
            "name" => $pla->name,
            "deck" => $pla->deck,
            "description" => $pla->description,
            "release_date" => $pla->release_date,
            "install_base" => $pla->install_date,
            "original_price" => $pla->original_price,
            "c_id" => $pla->c_id
        ];


        $rs = $rs->withHeader("Content-Type", "application/json");
        $rs->getBody()->write(json_encode($tab));
        return $rs;
    }
}