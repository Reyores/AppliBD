<?php
declare(strict_types=1);


namespace appbdd\projCont;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class ControlleurCommentaire
{

    private Container $containter;

    public function __construct(Container $c)
    {
        $this->containter = $c;

    }
}