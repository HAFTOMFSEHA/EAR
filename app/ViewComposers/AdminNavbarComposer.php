<?php

namespace App\ViewComposers;

use App\Http\Repositories\MenuRepository;
use App\Http\Services\MenuService;

class AdminNavbarComposer
{
	protected $menuRepository;

	protected $menuService;

	public function __construct(MenuRepository $menuRepository, MenuService $menuService)
	{
		$this->menuRepository = $menuRepository;
		$this->menuService = $menuService;
	}

	public function compose($view)
	{
		$main = $this->menuRepository->getAdminMainMenuList();

		$submenu = $this->menuRepository->getAdminSubMenuList();

		$menu = $this->menuService->composeAdminMenu($main, $submenu, request()->segments());

		return $view->with('menu', $menu);
	}
}
