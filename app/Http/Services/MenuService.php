<?php
namespace App\Http\Services;

use App\Models\Admin;
use Illuminate\Routing\UrlGenerator;
use Auth;

class MenuService
{
	protected $admin;

	protected $active;

	protected $activeMain;

	protected $resolvedSub = [];

	protected $resolvedMain = [];

	protected $filteredSub = [];

	public function __construct(UrlGenerator $url)
	{
        $this->url = $url;
        $this->admin = Auth::user();
    }

	public function composeAdminMenu($mainMenu, $subMenu, $requestSegments)
	{
		if(!$this->admin){
			return [];
        }

		$this->active = $this->getActiveMenu($requestSegments);

		$this->resolveMenu($mainMenu, $subMenu);

		return collect([
			'main'		=> $this->resolvedMain,
			'sub'		=> $this->filteredSub,
			'totalmenu' => $this->resolvedSub
		]);
	}

	public function getActiveMenu($requestSegments)
	{
        return $requestSegments[1];
	}

	public function resolveMenu($mainMenu, $subMenu)
	{
		$this->resolveSubMenu($subMenu);

		$this->resolveMainMenu($mainMenu);
	}

	public function resolveSubMenu($subMenu)
	{
        $subMenu = collect($this->setActiveSegment($subMenu, 'route'));
        $admin = $this->admin;
		$activeMenu = $this->active;
		$activeMain = $this->activeMain;

        // Access Controlled Active Menu
		$this->resolvedSub = $subMenu->filter(function ($item) use($admin, $activeMenu) {
			return true;

        });

       $this->filteredSub = $this->resolvedSub->filter(function($item) use($activeMain) {
			return $item['mainMenu'] == $activeMain;
		});
	}

	public function setActiveSegment($menu, $field)
	{
		$activeMenuList = [];
		$activeMenu = $this->active;
		foreach($menu as $item) {
			$activeSegment = $this->getActiveSegmentFromUrl($item[$field]);

			$item['activeSegment'] = $activeSegment;

			if ($activeMenu == $activeSegment) {
				$item['active'] = true;
				$this->setActiveMainMenu($item['mainMenu']);
			} else {
				$item['active'] = false;
			}

			$activeMenuList[] = $item;
		}
		return $activeMenuList;
	}

	public function setActiveMainMenu($active)
	{
		$this->activeMain = $active;
	}

	public function resolveMainMenu($mainMenu)
	{
        $mainMenu = collect($mainMenu)->keyBy('name');

		$subMainGroup = $this->resolvedSub->groupBy('mainMenu');

		$mainMenuWithSub = $mainMenu->only($subMainGroup->keys()->toArray());

		$mainMenuList = [];

		foreach($mainMenuWithSub as $item) {
			$item['route'] = $subMainGroup->get($item['name'])[0]['route'];
			$item['active'] = ($this->activeMain == $item['name']) ? true : false;
			$mainMenuList[] = $item;
		}
		$this->resolvedMain = collect($mainMenuList);
	}

	public function getActiveSegmentFromUrl($url)
	{
		$partition = explode($this->url->to('/'), $url);
		$segments = explode('/', $partition[1]);
		return $segments[2];
	}
}

?>
