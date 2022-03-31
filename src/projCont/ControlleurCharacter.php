<?php
declare(strict_types=1);

namespace appbdd\projCont;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;


class ControlleurCharacter
{
    private Container $container;

    public function __construct(Container $c)
    {
        $this->containter = $c;

    }
}