<?php
declare(strict_types=1);

namespace applibdd\projCont;

use appbdd\modele\Game;
use appbdd\modele\Utilisateurs;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class ControlleurJeux {
    private Container $containter;

    public function __construct(Container $c)
    {
        $this->containter = $c;

    }


    public function recupererJeuId(Request $rq, Response $rs, $args)
    {
    }
}
