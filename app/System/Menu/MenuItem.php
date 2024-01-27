<?php

namespace App\System\Menu;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class MenuItem
{

    public ?string $route = null;
    public ?string $link = null;
    public ?string $name;
    public string $code;
    public ?string $icon;
    public Collection $menu;

    public bool $visible = true;

    public ?string $description = null;

    public ?MenuItem $parent = null;

    public function __construct(string $code, string $name = null, array $menu = [])
    {
        $this->code = $code;
        $this->name = $name;
        $this->menu = collect($menu);
    }

    /**
     * Get the value of route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set the value of route
     *
     * @return  self
     */
    public function setRoute($route, $params = [])
    {
        $this->route = $route;
        if ($this->visible) {
            $this->link = route($route, $params);
        }

        return $this;
    }

    /**
     * Get the value of route
     */
    public function isActive($route = null, bool $self = true, bool $children = true)
    {
        if (!$route) {
            $route = Route::currentRouteName();
        }

        if ($self) {
            if ($route == $this->route) {
                return true;
            }
        }

        if ($children) {
            return $this->menu->filter(function (MenuItem $item) use ($route) {
                if ($item->menu->count()) {
                    return $item->isActive($route);
                } else {
                    return $route == $item->route;
                }
            })->count() ? true : false;
        }

        return false;
    }

    public function getActiveChild($route = null, $self = true, $recursive = true)
    {
        if (!$route) {
            $route = Route::currentRouteName();
        }

        if ($self) {
            if ($route == $this->route) {
                return $this;
            }
        }

        foreach ($this->menu as $item) {
            if ($item->isActive($route, true, false)) {
                return $item;
            }
            if ($item->isActive($route) && $recursive) {
                return $item->getActiveChild($route, false, true);
            }
        }
        return null;
    }

    public function getParent()
    {
      return $this->parent?$this->parent:$this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * add child menu value to menu
     *
     * @return  self
     */
    public function addMenu(...$menu)
    {
        foreach ($menu as $m) {
            $m->parent = $this;
            $this->menu->put($m->code, $m);
        }
        return $this;
    }

    /**
     * add child menu value to menu
     *
     * @return  self
     */
    public function removeMenu(string $code)
    {
        $this->menu->forget($code);
        return $this;
    }

    /**
     * Get the value of icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the value of icon
     *
     * @return  self
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Deprecated
     * This is cannot work anymore as now we create a parent item reference.
     * Nested self reference cannot be serialized.
     * @return void
     */
    public function toArray()
    {
        return json_decode(json_encode($this), true);
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setVisible(bool $visibilty)
    {
        $this->visible = $visibilty;
        return $this;
    }

}
