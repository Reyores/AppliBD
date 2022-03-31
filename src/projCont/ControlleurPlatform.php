<?php
declare(strict_types=1);

namespace appbdd\controllers;


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
}