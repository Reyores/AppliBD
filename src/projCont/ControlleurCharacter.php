<?php
declare(strict_types=1);

namespace appbdd\projCont;

use appbdd\modele\Character;
use appbdd\modele\Game2character;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class ControlleurCharacter
{
    private Container $container;

    public function __construct(Container $c)
    {
        $this->container = $c;

    }

    /**
     * Methode qui affiche une collection de character en fonction de l'id jeu en args
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function collectionCharacterJeu(Request $rq, Response $rs, array $args)
    {
        $tabC = Game2character::where('game_id', '=', $args['id'])->get();


        $characters = [];
        foreach ($tabC as $c) {
            $character = Character::where("id", "=", $c->character_id)->first();

            $tab["character"] = [
                "id" => $character->id,
                "name" => $character->name,
            ];


            $tab["links"] = ["self" => ["href" => $this->container->router->pathFor("pageCharacter", ["id" => $character->id])]];

            array_push($characters, $tab);

        }
        $t["characters"] = $characters;


        $rs = $rs->withHeader('Content-Type', "application/json");
        $rs->getBody()->write(json_encode($t));
        return $rs;
    }

    /**
     * Methode qui permet d'afficher le character un fonction de l'id
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function characterJeu(Request $rq, Response $rs, array $args)
    {

        $char = Character::where("id", "=", $args['id'])->first();

        $tab["character"] = ["id" => $char->id,
            "name" => $char->name,
            "real_name" => $char->real_name,
            "gender" => $char->gender,
            "deck" => $char->deck,
            "description" => $char->description,
            "first_appeared_in_game_id" => $char->first_appeared_in_game_id
        ];


        $rs = $rs->withHeader("Content-Type", "application/json");
        $rs->getBody()->write(json_encode($tab));
        return $rs;

    }
}