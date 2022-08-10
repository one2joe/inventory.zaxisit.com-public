<?php
/**
 * PHPMaker 2022 user level settings
 */
namespace PHPMaker2022\inventory;

// User level info
$USER_LEVELS = [["-2","Anonymous"],
    ["0","Default"]];
// User level priv info
$USER_LEVEL_PRIVS = [["{inventory}FontAwesome.php","-2","0"],
    ["{inventory}FontAwesome.php","0","0"],
    ["{inventory}item","-2","0"],
    ["{inventory}item","0","0"],
    ["{inventory}request","-2","0"],
    ["{inventory}request","0","0"],
    ["{inventory}user","-2","0"],
    ["{inventory}user","0","0"],
    ["{inventory}user_level","-2","0"],
    ["{inventory}user_level","0","0"],
    ["{inventory}user_level_permission","-2","0"],
    ["{inventory}user_level_permission","0","0"]];
// User level table info
$USER_LEVEL_TABLES = [["FontAwesome.php","FontAwesome","Font Awesome",false,"{inventory}","FontAwesome"],
    ["item","item","Item",true,"{inventory}","ItemList"],
    ["request","request2","Request",true,"{inventory}","Request2List"],
    ["user","user","User",true,"{inventory}","UserList"],
    ["user_level","user_level2","User Level",true,"{inventory}","UserLevel2List"],
    ["user_level_permission","user_level_permission","การเบิก",true,"{inventory}","UserLevelPermissionList"]];
