<?php
declare(strict_types=1);

namespace applibdd\controllers;


use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;


class ControlleurPlatform
{


    private Container $containter;

    public function __construct(Container $c)
    {
        $this->containter = $c;

    }
}