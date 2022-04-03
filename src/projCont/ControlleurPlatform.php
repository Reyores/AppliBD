<?php
declare(strict_types=1);

namespace appbdd\controllers;


use appbdd\modele\Game;
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

    public function platformJeu(ServerRequestInterface $rq, ResponseInterface $rs, array $args)
    {
    }
}