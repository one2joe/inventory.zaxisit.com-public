<?php

namespace PHPMaker2022\inventory;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(346, "mi_request2", $MenuLanguage->MenuPhrase("346", "MenuText"), $MenuRelativePath . "Request2List", -1, "", AllowListMenu('{inventory}request'), false, false, "fa fa-hand-holding", "", false, true);
$sideMenu->addMenuItem(345, "mi_item", $MenuLanguage->MenuPhrase("345", "MenuText"), $MenuRelativePath . "ItemList", -1, "", AllowListMenu('{inventory}item'), false, false, "fa fa-box", "", false, true);
$sideMenu->addMenuItem(337, "mi_user", $MenuLanguage->MenuPhrase("337", "MenuText"), $MenuRelativePath . "UserList", -1, "", AllowListMenu('{inventory}user'), false, false, "fa fa-user", "", false, true);
$sideMenu->addMenuItem(338, "mi_user_level2", $MenuLanguage->MenuPhrase("338", "MenuText"), $MenuRelativePath . "UserLevel2List", -1, "", AllowListMenu('{inventory}user_level'), false, false, "fas fa-user-tag", "", false, true);
$sideMenu->addMenuItem(342, "mi_FontAwesome", $MenuLanguage->MenuPhrase("342", "MenuText"), $MenuRelativePath . "FontAwesome", -1, "", AllowListMenu('{inventory}FontAwesome.php'), false, false, "", "", false, true);
echo $sideMenu->toScript();
