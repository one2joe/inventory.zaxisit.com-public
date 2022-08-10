<?php

namespace PHPMaker2022\inventory;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * FontAwesome controller
 */
class FontAwesomeController extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "FontAwesome");
    }
}
