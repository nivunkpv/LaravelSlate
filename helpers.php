<?php
use App\System\Menu\MenuItem;
use App\System\Menu\MenuSystem;
function mainmenu(): MenuItem
{
    $system = app(MenuSystem::class);
    return $system->menu("main-menu");
}

function menu(string $code): MenuItem
{
    $system = app(MenuSystem::class);
    return $system->menu($code);
}

function active_menu($reference = null)
{
    $main = mainmenu();
    foreach ($main->getMenu() as $item) {
        if ($item->isActive($reference)) {
            return $item;
        }
    }
    return null;
}

function alert($message,$type="ok"){
    $values = session("alerts", []);
    $values[] = [
        "type" => $type,
        "message" => $message,
    ];
    session()->flash("alerts", $values);
}
