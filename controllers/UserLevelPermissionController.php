<?php

namespace PHPMaker2022\inventory;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserLevelPermissionController extends ControllerBase
{
    // list
    public function list(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "UserLevelPermissionList");
    }

    // view
    public function view(Request $request, Response $response, array $args): Response
    {
        $args = $this->getKeyParams($args);
        return $this->runPage($request, $response, $args, "UserLevelPermissionView");
    }

    protected function getKeyParams($args)
    {
        $sep = Container("user_level_permission")->RouteCompositeKeySeparator;
        if (array_key_exists("keys", $args)) {
            $keys = explode($sep, $args["keys"]);
            return count($keys) == 2 ? array_combine(["User_Level_ID","Table_Name"], $keys) : $args;
        }
        return $args;
    }
}
