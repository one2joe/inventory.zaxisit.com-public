<?php

namespace PHPMaker2022\inventory;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // FontAwesome
    $app->map(["GET", "POST", "OPTIONS"], '/FontAwesome[/{params:.*}]', FontAwesomeController::class)->add(PermissionMiddleware::class)->setName('FontAwesome-FontAwesome-custom'); // custom

    // item
    $app->map(["GET","POST","OPTIONS"], '/ItemList[/{Item_ID}]', ItemController::class . ':list')->add(PermissionMiddleware::class)->setName('ItemList-item-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ItemAdd[/{Item_ID}]', ItemController::class . ':add')->add(PermissionMiddleware::class)->setName('ItemAdd-item-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ItemEdit[/{Item_ID}]', ItemController::class . ':edit')->add(PermissionMiddleware::class)->setName('ItemEdit-item-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ItemDelete[/{Item_ID}]', ItemController::class . ':delete')->add(PermissionMiddleware::class)->setName('ItemDelete-item-delete'); // delete
    $app->group(
        '/item',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{Item_ID}]', ItemController::class . ':list')->add(PermissionMiddleware::class)->setName('item/list-item-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{Item_ID}]', ItemController::class . ':add')->add(PermissionMiddleware::class)->setName('item/add-item-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{Item_ID}]', ItemController::class . ':edit')->add(PermissionMiddleware::class)->setName('item/edit-item-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{Item_ID}]', ItemController::class . ':delete')->add(PermissionMiddleware::class)->setName('item/delete-item-delete-2'); // delete
        }
    );

    // request2
    $app->map(["GET","POST","OPTIONS"], '/Request2List[/{Request_ID}]', Request2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('Request2List-request2-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/Request2Add[/{Request_ID}]', Request2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('Request2Add-request2-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/Request2Edit[/{Request_ID}]', Request2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('Request2Edit-request2-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/Request2Delete[/{Request_ID}]', Request2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('Request2Delete-request2-delete'); // delete
    $app->group(
        '/request2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{Request_ID}]', Request2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('request2/list-request2-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{Request_ID}]', Request2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('request2/add-request2-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{Request_ID}]', Request2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('request2/edit-request2-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{Request_ID}]', Request2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('request2/delete-request2-delete-2'); // delete
        }
    );

    // user
    $app->map(["GET","POST","OPTIONS"], '/UserList[/{User_ID}]', UserController::class . ':list')->add(PermissionMiddleware::class)->setName('UserList-user-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserAdd[/{User_ID}]', UserController::class . ':add')->add(PermissionMiddleware::class)->setName('UserAdd-user-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UserEdit[/{User_ID}]', UserController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserEdit-user-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UserDelete[/{User_ID}]', UserController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserDelete-user-delete'); // delete
    $app->group(
        '/user',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{User_ID}]', UserController::class . ':list')->add(PermissionMiddleware::class)->setName('user/list-user-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{User_ID}]', UserController::class . ':add')->add(PermissionMiddleware::class)->setName('user/add-user-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{User_ID}]', UserController::class . ':edit')->add(PermissionMiddleware::class)->setName('user/edit-user-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{User_ID}]', UserController::class . ':delete')->add(PermissionMiddleware::class)->setName('user/delete-user-delete-2'); // delete
        }
    );

    // user_level2
    $app->map(["GET","POST","OPTIONS"], '/UserLevel2List[/{User_Level_ID}]', UserLevel2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('UserLevel2List-user_level2-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserLevel2Delete[/{User_Level_ID}]', UserLevel2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('UserLevel2Delete-user_level2-delete'); // delete
    $app->group(
        '/user_level2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{User_Level_ID}]', UserLevel2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('user_level2/list-user_level2-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{User_Level_ID}]', UserLevel2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('user_level2/delete-user_level2-delete-2'); // delete
        }
    );

    // user_level_permission
    $app->map(["GET","POST","OPTIONS"], '/UserLevelPermissionList[/{keys:.*}]', UserLevelPermissionController::class . ':list')->add(PermissionMiddleware::class)->setName('UserLevelPermissionList-user_level_permission-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserLevelPermissionView[/{keys:.*}]', UserLevelPermissionController::class . ':view')->add(PermissionMiddleware::class)->setName('UserLevelPermissionView-user_level_permission-view'); // view
    $app->group(
        '/user_level_permission',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', UserLevelPermissionController::class . ':list')->add(PermissionMiddleware::class)->setName('user_level_permission/list-user_level_permission-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', UserLevelPermissionController::class . ':view')->add(PermissionMiddleware::class)->setName('user_level_permission/view-user_level_permission-view-2'); // view
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // userpriv
    $app->map(["GET","POST","OPTIONS"], '/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        if (Route_Action($app) === false) {
            return;
        }
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
